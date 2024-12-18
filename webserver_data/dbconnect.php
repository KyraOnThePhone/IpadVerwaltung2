<?php
include 'sessioncheck.php';
session_start();
if (!isset($_SESSION['loggedin'])) {
    echo "Nicht autorisiert.";
    exit;
}

// Verbindung zur MSSQL-Datenbank herstellen
$serverName = "sql, 1433";
$connectionInfo = array(
    "Database" => "IPadVerwaltung",
    "UID" => "sa",
    "PWD" => "BratwurstIN23!",
    "TrustServerCertificate" => true
);
$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}