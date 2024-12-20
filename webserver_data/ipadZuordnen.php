<?php
include 'jsonZugriff.php';
include 'dbconnect.php';

// Eingabewerte abrufen
$tabletId = isset($_POST['tabletId']) ? intval($_POST['tabletId']) : null;
$schuelerId = isset($_POST['schuelerId']) ? intval($_POST['schuelerId']) : null;
$ausgabeDatum = isset($_POST['ausgabeDatum']) ? $_POST['ausgabeDatum'] : null;
$geplanteAbgabe = isset($_POST['geplanteAbgabe']) ? $_POST['geplanteAbgabe'] : null;

// Validierung der Eingaben
if ($tabletId === null || $schuelerId === null || empty($ausgabeDatum) || empty($geplanteAbgabe)) {
    echo json_encode(["error" => "Ungültige Eingaben. Bitte geben Sie Tablet-ID, Schüler-ID, Ausgabe-Datum und geplante Abgabe ein."]);
    exit;
}

// Prozedur aufrufen
$sql = "{CALL dbo.TAusgabe(?, ?, ?, ?)}";
$params = array($tabletId, $schuelerId, $ausgabeDatum, $geplanteAbgabe);
$stmt = sqlsrv_query($conn, $sql, $params);

// Fehlerbehandlung
if ($stmt === false) {
    echo json_encode(["error" => sqlsrv_errors()[0]['message']]);
    exit;
}

// Erfolgsmeldung
echo json_encode(["success" => "Die Ausgabe wurde erfolgreich registriert und der Tablet-Status aktualisiert."]);

// Ressourcen freigeben
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>

