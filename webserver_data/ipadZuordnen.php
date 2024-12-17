<?php
include 'dbconnect.php';

// Eingabewerte abrufen
$tabletId = isset($_POST['tabletId']) ? intval($_POST['tabletId']) : null; // Tablet-ID
$schuelerId = isset($_POST['schuelerId']) ? intval($_POST['schuelerId']) : null; // Schüler-ID
$ausgabeDatum = isset($_POST['ausgabeDatum']) ? $_POST['ausgabeDatum'] : null; // Ausgabe-Datum
$geplanteAbgabe = isset($_POST['geplanteAbgabe']) ? $_POST['geplanteAbgabe'] : null; // Geplante Abgabe

// Validierung der Eingaben
if ($tabletId === null || $schuelerId === null || empty($ausgabeDatum) || empty($geplanteAbgabe)) {
    echo "Ungültige Eingaben. Bitte geben Sie Tablet-ID, Schüler-ID, Ausgabe-Datum und geplante Abgabe ein.";
    exit;
}

// Prozedur aufrufen
$sql = "{CALL dbo.TAusgabe(?, ?, ?, ?)}"; // Neue Prozeduraufruf
$params = array($tabletId, $schuelerId, $ausgabeDatum, $geplanteAbgabe);
$stmt = sqlsrv_query($conn, $sql, $params);

// Fehlerbehandlung
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Erfolgsmeldung
echo "Die Ausgabe wurde erfolgreich registriert und der Tablet-Status aktualisiert.";

// Ressourcen freigeben
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
