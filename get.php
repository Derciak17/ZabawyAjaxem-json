<?php
$con = mysqli_connect("localhost","root","","test");
if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$userdata = $_GET['userdata'];

if (isset($_GET['userdata'])) {

	$userdata = stripslashes($userdata);
	$userdata = mysqli_real_escape_string($con,$userdata);
	$query = "SELECT * FROM users WHERE user_id='".$userdata."'";
	$result = mysqli_query($con, $query) or die(mysqli_error($con));
	while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
		$imiedata = $row['imie'];
		$nazwiskodata = $row['nazwisko'];
		$emaildata = $row['email'];
	}
}

$json = array('imiedata' => $imiedata,
              'nazwiskodata' => $nazwiskodata,
		  	  'emaildata' => $emaildata);

$json = json_encode($json);
echo $json;
?>
