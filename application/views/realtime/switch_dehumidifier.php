<?php
if ($data_sensor->dehumidifier == "0") {
	echo '<a href="' . base_url('dehumidifier/on') . '" class="btn btn-danger mt-2">Switch ON</a>';
} elseif ($data_sensor->dehumidifier == "1") {
	echo '<a href="' . base_url('dehumidifier/off') . '" class="btn btn-info mt-2">Switch OFF</a>';
}
