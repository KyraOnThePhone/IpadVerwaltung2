<?php
include 'dbconnect.php';

// Eingabewerte abrufen
$status = isset($_POST['status']) ? trim($_POST['status']) : null; // Tablet-Status
$klasse = isset($_POST['klasse']) ? trim($_POST['klasse']) : null; // Klasse

// Validierung der Eingabe
if (empty($status) || empty($klasse)) {
    echo json_encode(["error" => "Ungültige Eingabe. Bitte geben Sie Status und Klasse an."]);
    exit;
}

// Prozedur "TabletStatusKlasse" aufrufen
$sql = "{CALL dbo.TabletStatusKlasse(?, ?)}"; // Prozeduraufruf mit Parametern
$params = array($status, $klasse);
$stmt = sqlsrv_query($conn, $sql, $params);

// Fehlerbehandlung
if ($stmt === false) {
    echo json_encode(["error" => "Fehler beim Abrufen der Daten: " . print_r(sqlsrv_errors(), true)]);
    exit;
}

// Ergebnisse verarbeiten
$tablets = [];
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
