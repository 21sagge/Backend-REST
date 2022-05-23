<?php
$conn = mysqli_connect("172.17.0.1:3306", "root", "pw", "mydb") or die("Connessione non riuscita: " . mysqli_connect_error());

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$page = $_GET['page'];
$size = $_GET['size'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $a = array();
    $query = "SELECT * FROM employees limit " . $page * $size . ',' . $size;
    $sql = mysqli_query($conn, $query);

    header('Content-Type: application/json;');

    while ($row = mysqli_fetch_array($sql, MYSQLI_NUM)) {
        $array = array(
            "id" => $row['0'],
            "birthDate" => $row['1'],
            "firstName" => $row['2'],
            "lastName" => $row['3'],
            "gender" => $row['4'],
            "hireDate" => $row['5']
        );
        array_push($a, $array);
    }

    $pagine = array();
    $pagine['_embedded']['employees'] = $a;

    $links = array();

    $query = "SELECT count(id) as count from employees";
    $sql = mysqli_query($conn, $query);
    
    while ($row = mysqli_fetch_array($sql, MYSQLI_NUM)) {
        $tot = $row[0];
    }

    $links["_links"]["prima"]["href"] = "http://localhost:8080/index.php" . '?page=' . '0' . "&size=" . $size;
    $links["_links"]['pag']['href'] = "http://localhost:8080/index.php" . '?page=' . $page . '&size=' . $size;
    $links["_links"]['succ']['href'] = "http://localhost:8080/index.php" . '?page=' . ($page + 1) . '&size=' . $size;
    $links["_links"]['prece']['href'] = "http://localhost:8080/index.php" . '?page=' . ($page - 1) . '&size=' . $size;
    $links["_links"]['ult']['href'] = "http://localhost:8080/index.php" . '?page=' . intval($tot / 20) . '&size=' . $size;

    $pages = array('size' => $size, 'totalElements' => $tot, 'totalPages' => intval($tot / 20), 'number' => intval($page));

    array_push($pagine, $links);
    array_push($pagine, $pages);
    echo json_encode($pagine, JSON_UNESCAPED_SLASHES);

} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = $_GET['nome'];
    $cognome = $_GET['cognome'];

    $query = "INSERT INTO employees (first_name, last_name) VALUES ('$nome','$cognome')";
    $sql = mysqli_query($conn, $query);

} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

    $id = $_GET['id'];     

    $query = " DELETE from employees where  id = '$id'";
    $sql = mysqli_query ($conn, $query);

} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {

    $id = $_GET['id'];
    $nome = $_GET['nome'];
    $cognome = $_GET['cognome'];

    $query = "UPDATE employees SET first_name = '$nome' , last_name= '$cognome' WHERE id = '$id'";
    $sql = mysqli_query($conn, $query);

}
