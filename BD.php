<?php
$servername = "localhost";
$username = "root";
$password = "";
$nombre_de_la_base_de_datos = 'seminariophp';

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// evita tener que poner "seminariophp.usuario" para los queries
mysqli_select_db($conn,$nombre_de_la_base_de_datos);


// echo "Connected successfully";
?>