<?php

//Debugging Code Snippet
error_reporting(E_ALL);
ini_set('display_errors', '1');

$winNumber = $_POST["win_number"];
$dateOfIncident = $_POST["date_of_incident"];
$imageFile = $_FILES["image"];
$description = $_POST["description"];

$servername = "localhost";
$username = "plugs";
$password = "phpplugs";
$dbName = "phpplugs";

$imageFileType = strtolower(pathinfo($imageFile["name"],PATHINFO_EXTENSION));
$imageTargetDir = "/var/www/html/phpplugs/m/";
$imageTargetFile = $imageTargetDir . $winNumber . "_" . time() . $imageFileType;

if (move_uploaded_file($imageFile['tmp_name'], $imageTargetFile)) {
    echo "File is valid, and was uploaded\n";

}
else {
    echo "Possible problem with file. \n";
    echo "<br>";
    echo "Unable to store file: " . $imageTargetFile;
    echo "<br><br>";
    }

$conn = new mysqli($servername, $username, $password, $dbName);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
$sql = "INSERT INTO report (winNumber, date, imageFile, description) VALUES (?, ?, ?, ?)";
