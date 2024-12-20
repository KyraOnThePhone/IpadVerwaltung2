<?php
include 'jsonZugriff.php';
include 'dbconnect.php';

// Eingabewerte abrufen
$tabletId = isset($_POST['search']) ? intval($_POST['search']) : null;
$date = isset($_POST['date']) ? $_POST['date'] : null;

// Validierung der Eingaben
if ($tabletId === null || empty($date)) {
    echo json_encode(["error" => "Ungültige Eingaben. Bitte geben Sie eine Tablet-ID und ein Datum ein."]);
    exit;
}

// Prozedur aufrufen
$sql = "{CALL dbo.HistoryT(?, ?)}";
$params = array($tabletId, $date);
$stmt = sqlsrv_query($conn, $sql, $params);

// Fehlerbehandlung
if ($stmt === false) {
    echo json_encode(["error" => sqlsrv_errors()[0]['message']]);
    exit;
}

// Ergebnisse sammeln
$data = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $row['Ausgabe am'] = $row['Ausgabe am'] ? $row['Ausgabe am']->format('Y-m-d') : null;
    $row['Geplante Abgabe'] = $row['Geplante Abgabe'] ? $row['Geplante Abgabe']->format('Y-m-d') : null;
    $row['Abgabe'] = $row['Abgabe'] ? $row['Abgabe']->format('Y-m-d') : "Noch nicht zurückgegeben";
    $data[] = $row;
}

// JSON-Ausgabe
header('Content-Type: application/json');
echo json_encode($data);

// Ressourcen freigeben
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
