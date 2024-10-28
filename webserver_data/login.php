<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo 'test';
session_start();
$serverName = "serverName\\sqlexpress, 1433"; 
$connectionInfo = array( "Database"=>"login", "UID"=>"sa", "PWD"=>"BratwurstIN23!");
$conn = sqlsrv_connect($serverName, $connectionInfo);
echo 'test2';

if ($conn === false) {
    echo 'test3';
    die(print_r(sqlsrv_errors(), true));
    
}

$sql = "SELECT id, password FROM Login WHERE username = ?";
$params = array($_POST['uname']);
$stmt = sqlsrv_query($conn, $sql, $params);
echo 'test4';


if ($stmt === false) {
    echo 'test5';

    die(print_r(sqlsrv_errors(), true));
}

if (sqlsrv_has_rows($stmt)) {
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $id = $row['id'];
    $password = $row['password'];

    if (password_verify($_POST['pw'], $password)) {
        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['name'] = $_POST['uname'];
        $_SESSION['id'] = $id;
        header('Location: admin.php');
        exit;
    } else {
        echo 'Passwort Stimmt nicht mit dem Username überein';
    }
} else {
    echo 'Username existiert nicht';
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
