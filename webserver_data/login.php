<?php
error_reporting(E_ALL);

ini_set('display_errors', 1);
session_start();


$serverName = "sql, 1433"; 
$connectionInfo = array(
    "Database" => "Login",
    "UID" => "sa",
    "PWD" => "BratwurstIN23!",
    "TrustServerCertificate" => true // Zertifikat ignorieren
);
$conn = sqlsrv_connect($serverName, $connectionInfo);



if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
    
}

$sql = "SELECT id, password FROM Accounts WHERE username = ?";
$params = array($_POST['uname']);
$stmt = sqlsrv_query($conn, $sql, $params);



if ($stmt === false) {
   

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
        
    } else {
        echo 'Passwort Stimmt nicht mit dem Username überein';
    }
} else {
    echo 'Username existiert nicht';
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
