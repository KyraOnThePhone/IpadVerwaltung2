<?php
include 'jsonZugriff.php';
include 'dbconnect.php';

// Eingabewerte abrufen
$tabletId = isset($_POST['tabletId']) ? intval($_POST['tabletId']) : null; // Tablet-ID

// Validierung der Eingabe
if ($tabletId === null || $tabletId <= 0) {
    echo "Ungültige Eingabe. Bitte geben Sie eine gültige Tablet-ID ein.";
    exit;
}

// Prozedur aufrufen
$sql = "{CALL dbo.TZGB(?)}"; // Prozeduraufruf für 'Gebraucht'
$params = array($tabletId);
$stmt = sqlsrv_query($conn, $sql, $params);

// Fehlerbehandlung
if ($stmt === false) {
    die("Fehler beim Aktualisieren des Tablet-Zustands: " . print_r(sqlsrv_errors(), true));
}

// Erfolgsmeldung
echo "Der Zustand des Tablets mit der ID $tabletId wurde erfolgreich auf 'Gebraucht' aktualisiert.";

// Ressourcen freigeben
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
