<?php
include 'jsonZugriff.php';
include 'dbconnect.php';

// SQL-Abfrage zur Prozedur "TabletAnzeige" aufrufen
$sql = "{CALL dbo.TabletAnzeige()}"; // Prozeduraufruf ohne Parameter
$stmt = sqlsrv_query($conn, $sql);

// Fehlerbehandlung
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Ergebnis verarbeiten
$tablets = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $tablets[] = $row;
}

// JSON-Ausgabe für das Frontend
header('Content-Type: application/json');
echo json_encode($tablets, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

// Ressourcen freigeben
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
