<?php
include 'dbconnect.php';

// Eingabewerte abrufen
$tabletId = isset($_POST['tabletId']) ? intval($_POST['tabletId']) : null; // Tablet-ID
$schuelerId = isset($_POST['schuelerId']) ? intval($_POST['schuelerId']) : null; // Schüler-ID
$abgabeDatum = isset($_POST['abgabeDatum']) ? $_POST['abgabeDatum'] : null; // Abgabedatum

// Validierung der Eingaben
if ($tabletId === null || $schuelerId === null || empty($abgabeDatum)) {
    echo "Ungültige Eingaben. Bitte geben Sie Tablet-ID, Schüler-ID und ein Abgabedatum ein.";
    exit;
}

// Prozedur aufrufen
$sql = "{CALL dbo.TRueckgabe(?, ?, ?)}"; // Prozeduraufruf
$params = array($tabletId, $schuelerId, $abgabeDatum);
$stmt = sqlsrv_query($conn, $sql, $params);

// Fehlerbehandlung
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Erfolgsmeldung
echo "Die Rückgabe wurde erfolgreich aktualisiert.";

// Ressourcen freigeben
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
