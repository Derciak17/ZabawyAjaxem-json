<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = "sdfsdfdsfsd71@gmail.com";

$mail->SetFrom("sdfsdfdsfsd71@gmail.com", "sdfsdfdsfsd71@gmail.com");
$mail->AddAddress("sdfsdfdsfsd71@gmail.com");

$mail->Subject = "$subject";
$mail->Body = "$message";
$mail->Send();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Zadanie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</head>
<style>
td{
    border: 1px solid #ffa434;
}
</style>
<body>

    <form>

        <input type="text" id="imie" placeholder="imie"/><br/>
        <input type="text" id="nazwisko" placeholder="nazwisko"/><br/>
        <input type="email" id="email" placeholder="email"/><br/>

        <button onclick="saveData();" type="button">Zapisz</button><br/>
		<h3 id="savemessage"><h3>
    </form>

	<br/><br/>

	<form>

		<input type="number" id="iddata" placeholder="Podaj numer osoby"/><br/>

		<button onclick="getData();" type="button">Odczytaj</button>
		<div id="displaydata">
		</div>
	</form>


	<table id="characters">
		<tr><td>Nazwa</td><td>Wzrost</td><td>Masa</td><td>Kolor włosów</td><td>Kolor skóry</td><td>Kolor oczu</td><td>Rok urodzenia</td><td>Płeć</td></tr>
	</table>

	<script>

	$(document).ready(function() {

		 function fetchPerson(id){

		   fetch(`https://swapi.co/api/people/${id}`)
		     .then( function(response){
		       return response.json()
		     })
		     .then(function(json){
		       console.log("data", json)

		       if (!json.name){
		         return;
		       }

		       name = json.name;
		       height = json.height;
			   mass = json.mass;
			   hair_color = json.hair_color;
			   skin_color = json.skin_color;
			   birth_year = json.birth_year;
			   gender = json.gender;
			   eye_color = json.eye_color;


			   if (height === 'unknown') {
				   height = "Nie wiadomo";
			   }

			   if (birth_year === 'unknown') {
				   birth_year = "Nie wiadomo";
			   }

			   if (hair_color === 'n/a') {
				   hair_color = "Brak";
			   } else {
				   if (hair_color === 'none') {
					   hair_color = "Brak";
				   }
			   }

			   if (mass === 'unknown') {
				   mass = "Nie wiadomo";
			   }

			   if (skin_color === 'unknown') {
				   skin_color = "Nie wiadomo";
			   }

			   if (gender === 'n/a') {
				   gender = "Nie określono";
			   } else {
				   if (gender === 'female') {
					   gender = 'Żeńska';
				   } else {
					   gender = 'Męska'
				   }
			   }


			   var characterstable = "<tr><td>"+name+"</td><td>"+height+"</td><td>"+mass+"</td><td>"+hair_color+"</td><td>"+skin_color+"</td><td>"+eye_color+"</td><td>"+birth_year+"</td><td>"+gender+"</td></tr>";
			   $('#characters').append(characterstable);



		     })
		 }
		 for (var i = 1; i <= 100; i++) {
		   fetchPerson(i)
		 }
	});

	    function getData()
	    {
			var iddata = document.getElementById('iddata').value;
	        $.ajax({
	            type: "GET",
	            url: "get.php?userdata="+iddata+"",
	            success: function(result){
					var json = JSON.parse(result);
					document.getElementById('displaydata').innerHTML =
					'<h3>Imie: <h2 id="imiedata">'+json.imiedata+'</h2>\
					<h3>Nazwisko: <h2 id="nazwiskodata">'+json.nazwiskodata+'</h2>\
					<h3>Email: <h2 id="emaildata">'+json.emaildata+'</h2>';
	            }
	        });
	    }

		function saveData()
		{
			var imiedataform = document.getElementById('imie').value;
			var nazwiskodataform = document.getElementById('nazwisko').value;
			var emaildataform = document.getElementById('email').value;
			$.ajax({
				type: "POST",
				url: "save.php",
				data: {imiedatasave: imiedataform, nazwiskodatasave: nazwiskodataform, emaildatasave: emaildataform},
				success: function(data){
					document.getElementById('savemessage').innerHTML = data;
				}
			});
		}
	</script>

</body>
</html>
