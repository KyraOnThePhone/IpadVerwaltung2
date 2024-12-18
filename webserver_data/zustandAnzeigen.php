<?php
include 'dbconnect.php';

// Eingabewerte abrufen
$zustand = isset($_POST['zustand']) ? trim($_POST['zustand']) : null; // Tablet-Zustand
$klasse = isset($_POST['klasse']) ? trim($_POST['klasse']) : null;   // Klasse

// Validierung der Eingabe
if (empty($zustand) || empty($klasse)) {
    echo json_encode(["error" => "Ungültige Eingabe. Bitte geben Sie Zustand und Klasse an."]);
    exit;
}

// Prozedur "TabletZustandKlasse" aufrufen
$sql = "{CALL dbo.TabletZustandKlasse(?, ?)}"; // Prozeduraufruf mit Parametern
$params = array($zustand, $klasse);
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
