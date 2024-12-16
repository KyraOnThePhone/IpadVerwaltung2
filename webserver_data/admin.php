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
                <li><?= htmlspecialchars($_SESSION['name'], ENT_QUOTES) ?></li>
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

            <!-- Tab Content -->
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
                    <button id="btn-refresh"><i class="material-icons">refresh</i></button>
                </div>
            </div>

            <div id="test-swipe-2" class="col s12 deep-purple lighten-4 white-text swipeTabs">
                <button id="btn-schueler" class="btn deep-purple darken-3">Schüler oder Schülernummer</button>
                <button id="btn-ipad" class="btn deep-purple darken-3">IPadnummer</button>
                <div class="input-field col s12">
                    <input id="search-input" type="text" placeholder="" disabled>
                    <label for="search-input" id="search-label" style="display: none;">Suchfeld</label>
                </div>
                <div class="input-field col s12">
                    <label for="datepicker">Zeitpunkt</label>
                    <input id="datepicker" type="text" class="datepicker">
                </div>
                <button id="refreshhistory"><i class="material-icons">refresh</i></button>
                <div id="output" class="output-container"></div>
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
    M.Tabs.init(document.querySelectorAll('.tabs'), { swipeable: true });

    // Select initialisieren
    M.FormSelect.init(document.querySelectorAll('select'));

    // Datepicker initialisieren
    M.Datepicker.init(document.querySelectorAll('.datepicker'));

    // Buttons für History Tab
    const inputField = document.getElementById("search-input");
    const inputLabel = document.getElementById("search-label");
    const btnSchueler = document.getElementById("btn-schueler");
    const btnIpad = document.getElementById("btn-ipad");

    if (btnSchueler) {
        btnSchueler.addEventListener("click", () => {
            inputField.disabled = false;
            inputField.placeholder = "Schüler oder Schülernummer eingeben...";
            inputLabel.textContent = "Schüler-Suchfeld";
            inputLabel.style.display = "block";
            inputField.focus();
        });
    }

    if (btnIpad) {
        btnIpad.addEventListener("click", () => {
            inputField.disabled = false;
            inputField.placeholder = "iPad-Nummer eingeben...";
            inputLabel.textContent = "iPad-Suchfeld";
            inputLabel.style.display = "block";
            inputField.focus();
        });
    }

    // Refresh-Button für History
    let searchType = null; // Variable, um den Typ der Suche zu speichern

// Event Listener für "Schüler"-Button
document.getElementById("btn-schueler").addEventListener("click", function () {
    searchType = 'schueler'; // Setze den Typ auf "Schüler"
    document.getElementById("search-input").disabled = false; // Suchfeld aktivieren
    document.getElementById("search-input").placeholder = "Schüler oder Schülernummer eingeben...";
    document.getElementById("search-label").textContent = "Schüler-Suchfeld";
    document.getElementById("search-label").style.display = "block";
});

// Event Listener für "iPad"-Button
document.getElementById("btn-ipad").addEventListener("click", function () {
    searchType = 'ipad'; // Setze den Typ auf "iPad"
    document.getElementById("search-input").disabled = false; // Suchfeld aktivieren
    document.getElementById("search-input").placeholder = "iPad-Nummer eingeben...";
    document.getElementById("search-label").textContent = "iPad-Suchfeld";
    document.getElementById("search-label").style.display = "block";
});

// Event Listener für den "Refresh"-Button
document.getElementById("refreshhistory").addEventListener("click", function () {
    const searchInput = document.getElementById("search-input").value;
    const datepicker = document.getElementById("datepicker").value;

    if (!searchType) {
        alert("Bitte wählen Sie aus, ob Sie nach Schüler oder iPad suchen möchten.");
        return;
    }

    if (!searchInput || !datepicker) {
        alert("Bitte geben Sie sowohl eine Suchnummer als auch ein Datum ein.");
        return;
    }

    const url = searchType === 'schueler' ? 'sushistory.php' : 'tablethistory.php';

    // AJAX-Aufruf an die entsprechende PHP-Datei
    $.ajax({
        url: url,
        method: 'POST',
        data: {
            search: searchInput,
            date: datepicker
        },
        success: function (response) {
            document.getElementById("output").innerHTML = response;
        },
        error: function (xhr, status, error) {
            console.error("Fehler bei AJAX:", status, error);
        }
    });
});

});
</script>
</body>
</html>

