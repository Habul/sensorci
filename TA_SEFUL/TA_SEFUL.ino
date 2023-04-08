#include "DHT.h"
#include <Arduino.h>
#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>
#include <Hash.h>
#include <Adafruit_Sensor.h>
#include <DHT.h>
#include <WiFiClient.h>

#define DHTPINA D6 //Dht11
#define DHTTYPE_A DHT11

#define DHTPINB D4 //DHT22
#define DHTTYPE_B DHT22

DHT dhta(DHTPINA, DHTTYPE_A);
DHT dhtb(DHTPINB, DHTTYPE_B);

WiFiClient wifiClient;

int relayFan = D5;
int relayDehumid = D3;
//integer relay

float t = 0.0;
float h = 0.0;
// current temperature & humidity, updated in loop()

// Generally, you should use "unsigned long" for variables that hold time
// The value will quickly become too large for an int to store
unsigned long previousMillis = 0;    // will store last time DHT was updated

// Updates DHT readings every 10 seconds
const long interval = 5000;

// Network SSID
const char* ssid = "DAFFA DENIS";
const char* password = "11182230";

const char* host = "192.168.100.43";  //IP Komputer / server

void setup() {
  Serial.begin(9600);
  Serial.println(F("DHT sensor test!"));

  dhta.begin();
  dhtb.begin();

  pinMode(DHTPINA, INPUT);
  pinMode(DHTPINB, INPUT);
  pinMode(relayFan, OUTPUT);
  pinMode(relayDehumid, OUTPUT);

  WiFi.hostname("NodeMCU");
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi connected");

}

void loop() {

  const int httpPort = 8080;
  if (!wifiClient.connect(host, httpPort))
  {
    Serial.println("connection failed");
    return;
  }

  unsigned long currentMillis = millis();
  if (currentMillis - previousMillis >= interval)
  {
    // save the last time you updated the DHT values
    previousMillis = currentMillis;
    // Read temperature as Celsius (the default)
    float newT = dhta.readTemperature();
    // Read temperature as Fahrenheit (isFahrenheit = true)
    //float newT = dht.readTemperature(true);
    // if temperature read failed, don't change t value

    String LinkOto;
    HTTPClient httpOto;
    LinkOto = "http://" + String(host) + ":8080/sensorci/check/otomatis";
    httpOto.begin(wifiClient, LinkOto);
    httpOto.GET();
    String responseOto = httpOto.getString();
    Serial.println(responseOto);
    httpOto.end();

    String oto;
    if (responseOto == "ON")
    {
      oto = Serial.println(0);
    }

    if (oto.toInt() == 0)
    {
      String LinkRelay;
      HTTPClient httpRelay;
      LinkRelay = "http://" + String(host) + ":8080/sensorci/check/kipas";
      httpRelay.begin(wifiClient, LinkRelay);
      httpRelay.GET();
      String responseRelay = httpRelay.getString();
      httpRelay.end();

      if (responseRelay == "ON")
      { digitalWrite(relayFan, LOW);
        Serial.println("Kipas Nyala Manual");
      }
      else
      { digitalWrite(relayFan, HIGH);
        Serial.println("Kipas Mati Manual");
      }
    }
    else
    {
      if (newT >= 25)
      { digitalWrite(relayFan, LOW);
        Serial.println("Kipas Nyala Otomatis");
      }
      else
      { digitalWrite(relayFan, HIGH);
        Serial.println("Kipas Mati Otomatis");
      }
      //Otomatisasi Kipas
    }

    if (isnan(newT))
    {
      Serial.println("Failed to read from DHT sensor 11");
    }
    else
    {
      t = newT;
      Serial.println(t);
    }

    // Read Humidity
    float newH1 = dhtb.readHumidity();
    // if humidity read failed, don't change h value

    if (oto.toInt() == 0)
    {
      String LinkDehum;
      HTTPClient httpDehum;
      LinkDehum = "http://" + String(host) + ":8080/sensorci/check/dehumidifier";
      httpDehum.begin(wifiClient, LinkDehum);
      httpDehum.GET();
      String responseDehum = httpDehum.getString();
      httpDehum.end();

      if (responseDehum == "ON")
      { digitalWrite(relayDehumid, LOW);
        Serial.println("Dehumidifier Nyala Manual");
      }
      else
      { digitalWrite(relayDehumid, HIGH);
        Serial.println("Dehumidifier Nyala Manual");
      }
    }
    else
    {
      if (newH1 >= 50)
      { digitalWrite(relayDehumid, LOW);
        Serial.println("Dehumidifier Nyala Otomatis");
      }
      else
      { digitalWrite(relayDehumid, HIGH);
        Serial.println("Dehumidifier Mati Otomatis");
      }
      //Otomatisasi Dehumidifier
    }

    if (isnan(newH1))
    {
      Serial.println("Failed to read from DHT sensor 22");
    }
    else
    {
      h = newH1;
      Serial.println(h);
    }
  }

  String Link;
  HTTPClient http;
  Link = "http://" + String(host) + ":8080/sensorci/update/" + String(t) + "/" + String(h);
  http.begin(wifiClient, Link);
  http.GET();
  http.end();

}
