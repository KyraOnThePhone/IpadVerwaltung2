<?php
include 'jsonZugriff.php';
include 'dbconnect.php';

// Prozedur "Klassenanzeige" aufrufen
$sql = "{CALL dbo.Klassenanzeige()}"; // Prozeduraufruf ohne Parameter
$stmt = sqlsrv_query($conn, $sql);

// Fehlerbehandlung
if ($stmt === false) {
    echo json_encode(["error" => "Fehler beim Abrufen der Klassen: " . print_r(sqlsrv_errors(), true)]);
    exit;
}

// Ergebnis verarbeiten
$klassen = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $klassen[] = $row;
}

// JSON-Ausgabe für das Frontend
header('Content-Type: application/json');
echo json_encode($klassen, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

// Ressourcen freigeben
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
