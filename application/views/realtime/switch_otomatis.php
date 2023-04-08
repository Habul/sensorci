<?php
if ($data_sensor->otomatis == "0") {
	echo '<a href="' . base_url('otomatis/on') . '" class="btn btn-danger mt-2">Switch ON</a>';
} elseif ($data_sensor->otomatis == "1") {
	echo '<a href="' . base_url('otomatis/off') . '" class="btn btn-info mt-2">Switch OFF</a>';
}
