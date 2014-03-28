<?php

//zorgen dat er verbinding is met de database zodat wij hier gegevens in kunnen zetten en ophalen
$link = mysqli_connect('localhost', 'project', 'username', 'password');

if(!$link) {
	die ('Could not connect' . mysqli_error());
	}
?>