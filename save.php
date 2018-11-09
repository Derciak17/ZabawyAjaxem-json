<?php
$con = mysqli_connect("localhost","root","","test");
if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$imiedatasave = $_POST['imiedatasave'];
$nazwiskodatasave = $_POST['nazwiskodatasave'];
$emaildatasave = $_POST['emaildatasave'];

if (isset($_POST['imiedatasave']) && ($_POST['nazwiskodatasave']) && ($_POST['emaildatasave'])) {

	$imiedatasave = stripslashes($imiedatasave);
	$imiedatasave = mysqli_real_escape_string($con,$imiedatasave);
	$nazwiskodatasave = stripslashes($nazwiskodatasave);
	$nazwiskodatasave = mysqli_real_escape_string($con,$nazwiskodatasave);
	$emaildatasave = stripslashes($emaildatasave);
	$emaildatasave = mysqli_real_escape_string($con,$emaildatasave);
	$query = "INSERT INTO `users` (`imie`, `nazwisko`, `email`) VALUES ('".$imiedatasave."', '".$nazwiskodatasave."', '".$emaildatasave."')";
		$result = mysqli_query($con,$query);
		if($result){
			echo "Sukces zapisano!!";
		}
}
?>
