<?php
//tao ket noi database
$hostname = "localhost";
$username = "root";
$password = "";
$databasename = "game_vui";

$con = mysqli_connect($hostname, $username, $password, $databasename);
mysqli_query($con, "SET NAMES 'UTF8'");

$sql_1 = "SELECT * FROM config";
$result = mysqli_query($con, $sql_1);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $time_max = $row["time_max"];
        $so_max = $row["so_max"];
        $so_cau_hoi_max = $row["so_cau_hoi_max"];
        $ket_qua_cu = $row["ket_qua_cu"];
    }
} else {
    echo "0 results";
}
//lay du lieu database thanh cong

$so_thu_nhat = rand(0, $so_max);
$so_thu_hai = rand(0, $so_max);

//Tao phep toan ngau nhien
switch (rand(0,2)){
    case 0:
        $phep_toan = "$so_thu_nhat" . " x " . "$so_thu_hai";
        $ket_qua = $so_thu_nhat * $so_thu_hai;
        break;
    case 1:
        $phep_toan = "$so_thu_nhat" . " + " . "$so_thu_hai";
        $ket_qua = $so_thu_nhat + $so_thu_hai;
        break;
    case 2:
        $phep_toan = "$so_thu_nhat" . " - " . "$so_thu_hai";
        $ket_qua = $so_thu_nhat - $so_thu_hai;
        break;
}

//Tao bo ket qua ngau nhien
$bo_ket_qua = array(
    $ket_qua,
    rand(0 - $so_max, $so_max * $so_max),
    rand(0 - $so_max, $so_max * $so_max),
    rand(0 - $so_max, $so_max * $so_max)
);
shuffle($bo_ket_qua);

// tao mang du lieu tra ve
$arr = array(
    "check_correr" => true,
    "score_max" => $so_cau_hoi_max,
    "time_max" => $time_max,
    "phep_toan" => $phep_toan,
    "bo_ket_qua" => $bo_ket_qua,
);


// kiem tra du lieu post len
if(isset($_POST["data"]) && $_POST["data"] != $ket_qua_cu){
    $arr = array(
        "check_correr" => false,
        "score_max" => $so_cau_hoi_max,
        "time_max" => $time_max,
        "phep_toan" => $phep_toan,
        "bo_ket_qua" => $bo_ket_qua,
    );
}


// luu ket qua dung vao database
$sql_2 = "UPDATE config SET ket_qua_cu = $ket_qua";
$result = mysqli_query($con, $sql_2);

echo json_encode($arr);

$con->close();//ngat ket noi database
?>
