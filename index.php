<?php
    $servername = "172.17.0.1:3306";
    $user = "root";
    $pass = "pise";
    $db="mydb";

    // Create connection
    $conn = mysqli_connect($servername, $user, $pass, $db) or die("Connessione non riuscita". mysqli_connect_error());

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    $data = ['id' => 10001, 'birthDate' => "1953-09-01", 'firstName' => 'Georgi', 'lastName' => 'Facello', 'gender' => 'M', 'hireDate' => '1986-06-25'];
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // The request is using the GET method
        echo json_encode($data);
        $sql = "SELECT * from employees";
        $result = $conn->query($sql);
        echo ($result);
        return $result;
    }else 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // The request is using the POST method
        echo json_encode($data);
    }else 
    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        // The request is using the DELETE method
        echo json_encode($data);
    }else 
    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        // The request is using the PUT method
        echo json_encode($data);
    }
?>