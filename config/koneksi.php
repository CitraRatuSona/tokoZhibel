<?php
error_reporting(0);
$con = mysqli_connect("localhost","root","","suryajaya");
if(mysqli_connect_errno($con)) {
	echo "Failed to connect MySQL" .mysqli_connect_error();
}
else {
	echo "";
}
?>