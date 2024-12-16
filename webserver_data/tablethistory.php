<?php
$query = "EXEC HistoryT @TID = ?, @Date = ?";
$params = array($tid, $date);

// Query ausführen
$stmt = sqlsrv_query($conn, $query, $params);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
} 

// Ergebnisse verarbeiten
$results = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $results[] = $row;
}
sqlsrv_free_stmt($stmt); // Ressourcen freigeben

if (!empty($results)) {
    echo "<table class='striped'>";
    echo "<thead>
            <tr>
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
            </tr>
          </thead><tbody>";

    foreach ($results as $row) {
        echo "<tr>";
        echo "<td>{$row['SchülerID']}</td>";
        echo "<td>{$row['Vorname']}</td>";
        echo "<td>{$row['Nachname']}</td>";
        echo "<td>{$row['Straße']}</td>";
        echo "<td>{$row['PLZ']}</td>";
        echo "<td>{$row['Ort']}</td>";
        echo "<td>{$row['TabletID']}</td>";
        echo "<td>{$row['Zustand']}</td>";
        echo "<td>{$row['Ausgabe am']}</td>";
        echo "<td>{$row['Geplante Abgabe']}</td>";
        echo "<td>{$row['Abgabe']}</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
} else {
    echo "Keine Daten gefunden.";
}
