<?php
include 'jsonZugriff.php';
include 'dbconnect.php';

$tabletId = isset($_POST['tabletId']) ? intval($_POST['tabletId']) : null;

if ($tabletId === null || $tabletId <= 0) {
    echo json_encode(["error" => "Ungültige Eingabe. Bitte geben Sie eine gültige Tablet-ID ein."]);
    exit;
}

$sql = "{CALL dbo.TZG(?)}";
$params = array($tabletId);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    echo json_encode(["error" => "Fehler beim Aktualisieren des Tablet-Zustands: " . print_r(sqlsrv_errors(), true)]);
    exit;
}

echo json_encode(["success" => "Der Zustand des Tablets mit der ID $tabletId wurde erfolgreich auf 'Gut' aktualisiert."]);

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>

