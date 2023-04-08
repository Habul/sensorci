<?php
if ($data_sensor->dehumidifier == "1") {
	echo "ON";
} elseif ($data_sensor->dehumidifier == "0") {
	echo "OFF";
}
