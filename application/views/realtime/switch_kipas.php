<?php
if ($data_sensor->kipas == "0") {
	echo '<a href="' . base_url('kipas/on') . '" class="btn btn-danger mt-2">Switch ON</a>';
} elseif ($data_sensor->kipas == "1") {
	echo '<a href="' . base_url('kipas/off') . '" class="btn btn-info mt-2">Switch OFF</a>';
}
