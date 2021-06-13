<?php
$hostname = "localhost";
$username = "root";
$password = "";
$databasename = "game_vui";

$con = mysqli_connect($hostname, $username, $password, $databasename);
mysqli_query($con, "SET NAMES 'UTF8'");

$array = array();
class Person{
    function Person($name, $score) {
        $this->name = $name;
        $this->score = $score;
    }
}

//if(isset($_GET['']))
{
    $sql = "SELECT * FROM `bang_xep_hang` ORDER BY score DESC LIMIT 7";
    $data = mysqli_query($con, $sql);
    
    while ($row = mysqli_fetch_assoc($data)) {
        // output data of each row
        array_push($array, new Person($row['name'], $row['score']));
    }
    echo json_encode($array);
}

if(isset($_POST["score"]))
{
    $name = $_POST["name"];
    $score = $_POST["score"];
    $sql = "INSERT INTO `bang_xep_hang` (`name`, `score`) VALUES ('$name', '$score')";
    $data = mysqli_query($con, $sql);
}
