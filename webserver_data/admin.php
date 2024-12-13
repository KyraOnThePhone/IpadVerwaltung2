<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ipad Verwaltung</title>
    <!-- Materialize CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="Adminstyle.css">
</head>
<body>
<header>
    <nav>
        <div class="nav-wrapper deep-purple darken-3">
            <a href="#!" class="brand-logo"><i class="material-icons">tablet_mac</i>IPad Verwaltung</a>
            <ul class="right hide-on-med-and-down">
                <li><i class="material-icons">account_box</i></li>
                <li><?=htmlspecialchars($_SESSION['name'], ENT_QUOTES)?></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
</header>

<main>
    <div class="container">
        <div class="row">
        <ul id="tabs-swipe-demo" class="tabs tabs-fixed-width center-align">

                <li class="tab col s3"><a class="active" href="#test-swipe-1">Filter</a></li>
                <li class="tab col s3"><a href="#test-swipe-2">History</a></li>
                <li class="tab col s3"><a href="#test-swipe-3">Datei Upload</a></li>
                <li class="tab col s3"><a href="#test-swipe-4">IPads verwalten</a></li>
                <li class="tab col s3"><a href="#test-swipe-5">Alle IPads</a></li>
            </ul>

<div id="test-swipe-1" class="col s12 container deep-purple lighten-4 white-text swipeTabs">
    <button>gestohlene/verlorene IPads</button>
    <button>IPads mit gutem Zustand</button>
    <button>IPads mit schlechtem Zustand</button>
    <button>verliehene IPads</button>
    <button>freie IPads</button>

    <div class="input-field col s12">
        <select id="form-select-1">
            <option value="">alle Klassen</option>
            <option value="1">Klasse</option>
            <option value="2">Klasse 1</option>
            <option value="3">Klasse 3</option>
        </select>
        <label for="form-select-1">IPads dieser Klasse anzeigen:</label>
    </div>
    <div>
    <button><i class="material-icons">refresh</i></button>
    </div>
    <div>Ausgabe</div>
</div>

<div id="test-swipe-2" class="col s12 deep-purple lighten-4 white-text swipeTabs">
    <button id="btn-schueler" class="btn deep-purple darken-3">Schüler oder Schülernummer</button>
    <button id="btn-ipad" class="btn deep-purple darken-3">IPadnummer</button>

    <div class="input-field col s12">
        <input
            id="search-input"
            type="text"
            placeholder=""
            disabled
        />
        <label for="search-input" id="search-label" style="display: none;">Suchfeld</label>
        <div class="input-field col s12">
    <label for="datepicker">Zeitpunkt</label>
    <input id="datepicker" type="text" class="datepicker">
</div>
<button><i class="material-icons">refresh</i></button>
    </div>
    <div>Ausgabe</div>
</div>

            <div id="test-swipe-3" class="col s12 deep-purple lighten-4 white-text swipeTabs">
            <div class="file-field input-field">
      <div class="btn deep-purple darken-3">
        <span>Datei upload</span>
        <input type="file">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" placeholder="CSV Datei auswählen | Keine Datei ausgewählt" type="text">
      </div>
 
    </div>
    <div>
        <button>Daten einpflegen</button>
      </div>
            </div>
            <div id="test-swipe-4" class="col s12 deep-purple lighten-4 white-text swipeTabs">
    <!-- Buttons für Auswahl der Funktion -->
    <button id="btn-trennen" class="btn deep-purple darken-3">Schüler von IPads trennen</button>
    <button id="btn-zuordnen" class="btn deep-purple darken-3">IPad zuordnen</button>
    <button id="btn-zustand" class="btn deep-purple darken-3">IPad Zustand ändern</button>
    
    <!-- Dynamisches Formular -->
    <form id="ipad-form" style="margin-top: 20px;">
        <h5 id="form-title">Aktion auswählen</h5>
        <div id="form-content">
            <!-- Hier werden die Inputs dynamisch eingefügt -->
        </div>
        <button class="btn green darken-3" type="submit">Aktion ausführen</button>
    </form>
</div>

            <div id="test-swipe-5" class="col s12 deep-purple lighten-4 white-text swipeTabs">
                Output
            </div>
            
        </div>
    </div>
</main>

<footer class="page-footer deep-purple darken-3">
    <div class="container">
        <span class="white-text">© 2024 Ipad Verwaltung</span>
    </div>
</footer>

<!-- Materialize JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Tabs initialisieren
    const tabs = document.querySelectorAll('.tabs');
    M.Tabs.init(tabs, { swipeable: true });

    // Select initialisieren
    const selects = document.querySelectorAll('select');
    M.FormSelect.init(selects);

    // Höhe des Tabs-Containers setzen
    $(".tabs-content").css({
        height: '75vh'
    });

    // Datepicker initialisieren
    const datepickers = document.querySelectorAll('.datepicker');
    M.Datepicker.init(datepickers, {
        // Optionen für den Datepicker können hier spezifiziert werden
    });

    // Textfeld & Buttons (History Tab)
    const inputField = document.getElementById("search-input");
    const inputLabel = document.getElementById("search-label");
    const btnSchueler = document.getElementById("btn-schueler");
    const btnIpad = document.getElementById("btn-ipad");

    // Event Listener für "Schüler"-Button
    btnSchueler.addEventListener("click", () => {
        inputField.disabled = false; // Textfeld aktivieren
        inputField.placeholder = "Schüler oder Schülernummer eingeben..."; // Passenden Placeholder setzen
        inputLabel.textContent = "Schüler-Suchfeld"; // Label anpassen
        inputLabel.style.display = "block"; // Label anzeigen
        inputField.focus(); // Fokus auf Textfeld setzen
    });

    // Event Listener für "iPad"-Button
    btnIpad.addEventListener("click", () => {
        inputField.disabled = false; // Textfeld aktivieren
        inputField.placeholder = "iPad-Nummer eingeben..."; // Passenden Placeholder setzen
        inputLabel.textContent = "iPad-Suchfeld"; // Label anpassen
        inputLabel.style.display = "block"; // Label anzeigen
        inputField.focus(); // Fokus auf Textfeld setzen
    });

    // Dynamisches Formular (iPads verwalten)
    const btnTrennen = document.getElementById('btn-trennen');
    const btnZuordnen = document.getElementById('btn-zuordnen');
    const btnZustand = document.getElementById('btn-zustand');
    const formTitle = document.getElementById('form-title');
    const formContent = document.getElementById('form-content');

    // Funktion: Formular dynamisch aktualisieren
function updateForm(action) {
    formContent.innerHTML = ''; // Vorherige Inhalte löschen
    let html = '';

    if (action === 'trennen') {
        formTitle.textContent = 'Schüler von IPad trennen';
        html = `
            <div class="input-field">
                <select id="ipad-select">
                    <option value="" disabled selected>Wähle ein iPad aus</option>
                    <option value="1">iPad 1</option>
                    <option value="2">iPad 2</option>
                    <option value="3">iPad 3</option>
                </select>
                <label for="ipad-select">IPad auswählen</label>
            </div>
            <button id="action-button" class="btn btn-deep-purple">Trennen</button>
        `;
    } else if (action === 'zuordnen') {
        formTitle.textContent = 'IPad einem Schüler zuordnen';
        html = `
            <div class="input-field">
                <select id="ipad-select">
                    <option value="" disabled selected>Wähle ein iPad aus</option>
                    <option value="1">iPad 1</option>
                    <option value="2">iPad 2</option>
                    <option value="3">iPad 3</option>
                </select>
                <label for="ipad-select">IPad auswählen</label>
            </div>
            <div class="input-field">
                <input type="text" id="student-id" placeholder="Schüler-ID eingeben">
                <label for="student-id">Schüler-ID</label>
            </div>
            <button id="action-button" class="btn btn-deep-purple">Zuordnen</button>
        `;
    } else if (action === 'zustand') {
        formTitle.textContent = 'IPad Zustand ändern';
        html = `
            <div class="input-field">
                <select id="ipad-select">
                    <option value="" disabled selected>Wähle ein iPad aus</option>
                    <option value="1">iPad 1</option>
                    <option value="2">iPad 2</option>
                    <option value="3">iPad 3</option>
                </select>
                <label for="ipad-select">IPad auswählen</label>
            </div>
            <div class="input-field">
                <select id="ipad-status">
                    <option value="" disabled selected>Zustand auswählen</option>
                    <option value="good">Gut</option>
                    <option value="fair">In Ordnung</option>
                    <option value="bad">Schlecht</option>
                </select>
                <label for="ipad-status">Zustand</label>
            </div>
            <button id="action-button" class="btn btn-deep-purple">Zustand ändern</button>
        `;
    }

    formContent.innerHTML = html;

    // Materialize-Komponenten initialisieren
    const selects = document.querySelectorAll('select');
    M.FormSelect.init(selects);
}


    // Event-Listener für die Buttons
    btnTrennen.addEventListener('click', () => updateForm('trennen'));
    btnZuordnen.addEventListener('click', () => updateForm('zuordnen'));
    btnZustand.addEventListener('click', () => updateForm('zustand'));
});

      

</script>

</body>
</html>
