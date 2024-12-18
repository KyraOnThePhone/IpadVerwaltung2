<?php
include 'jsonZugriff.php';
include 'dbconnect.php';
// Eingabewerte abrufen
$schuelerId = isset($_POST['search']) ? intval($_POST['search']) : null; // Schüler ID aus POST
$date = isset($_POST['date']) ? $_POST['date'] : null; // Datum aus POST

// Validierung der Eingaben
if ($schuelerId === null || empty($date)) {
    echo "Ungültige Eingaben. Bitte geben Sie eine Schüler-ID und ein Datum ein.";
    exit;
}

// Prozedur aufrufen
$sql = "{CALL dbo.HistoryS(?, ?)}"; // Prozeduraufruf
$params = array($schuelerId, $date);
$stmt = sqlsrv_query($conn, $sql, $params);

// Fehlerbehandlung
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Ergebnisse anzeigen
echo "<table class='striped'>";
echo "<thead><tr>
    <th>SchülerID</th>
    <th>Vorname</th>
    <th>Nachname</th>
    <th>Straße</th>
    <th>PLZ</th>
    <th>Ort</th>
    <th>TabletID</th>
    <th>Zustand</th>
    <th>Ausgabe am</th>
    <th>Geplante Abgabe</th>
    <th>Abgabe</th>
</tr></thead><tbody>";

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['SchülerID']) . "</td>";
    echo "<td>" . htmlspecialchars($row['Vorname']) . "</td>";
    echo "<td>" . htmlspecialchars($row['Nachname']) . "</td>";
    echo "<td>" . htmlspecialchars($row['Straße']) . "</td>";
    echo "<td>" . htmlspecialchars($row['PLZ']) . "</td>";
    echo "<td>" . htmlspecialchars($row['Ort']) . "</td>";
    echo "<td>" . htmlspecialchars($row['TabletID']) . "</td>";
    echo "<td>" . htmlspecialchars($row['Zustand']) . "</td>";
    echo "<td>" . htmlspecialchars($row['Ausgabe am']->format('Y-m-d')) . "</td>";
    echo "<td>" . htmlspecialchars($row['Geplante Abgabe']->format('Y-m-d')) . "</td>";
    echo "<td>" . ($row['Abgabe'] ? htmlspecialchars($row['Abgabe']->format('Y-m-d')) : "Noch nicht zurückgegeben") . "</td>";
    echo "</tr>";
}
echo "</tbody></table>";

// Ressourcen freigeben
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
