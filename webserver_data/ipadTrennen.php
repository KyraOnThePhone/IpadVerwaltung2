<?php
include 'jsonZugriff.php';
include 'dbconnect.php';

// Eingabewerte abrufen
$tabletId = isset($_POST['tabletId']) ? intval($_POST['tabletId']) : null;
$schuelerId = isset($_POST['schuelerId']) ? intval($_POST['schuelerId']) : null;
$abgabeDatum = isset($_POST['abgabeDatum']) ? $_POST['abgabeDatum'] : null;

// Validierung der Eingaben
if ($tabletId === null || $schuelerId === null || empty($abgabeDatum)) {
    echo json_encode(["error" => "Ungültige Eingaben. Bitte geben Sie Tablet-ID, Schüler-ID und ein Abgabedatum ein."]);
    exit;
}

// Prozedur aufrufen
$sql = "{CALL dbo.TRueckgabe(?, ?, ?)}";
$params = array($tabletId, $schuelerId, $abgabeDatum);
$stmt = sqlsrv_query($conn, $sql, $params);

// Fehlerbehandlung
if ($stmt === false) {
    echo json_encode(["error" => sqlsrv_errors()[0]['message']]);
    exit;
}

// Erfolgsmeldung
echo json_encode(["success" => "Die Rückgabe wurde erfolgreich aktualisiert."]);

// Ressourcen freigeben
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>

