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
      <div>
        <a href="fancy.gif" download="rickroll"><button><i class="material-icons">download</i>CSV Vorlage</button></a>
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
            <!-- Eingabefelder werden hier dynamisch eingefügt -->
        </div>
        <button id="submit-action" class="btn deep-purple darken-3" type="button">Aktion ausführen</button>
    </form>
    <div id="output-ipad" class="output-container"></div>
</div>


            <div id="test-swipe-5" class="col s12 deep-purple lighten-4 white-text swipeTabs">
            <div id="outputAll" class="output-container"></div>
            </div>
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
    // Materialize-Komponenten initialisieren
    M.Tabs.init(document.querySelectorAll('.tabs'), { swipeable: true });

    function initMaterialize() {
        M.FormSelect.init(document.querySelectorAll('select'));
        M.Datepicker.init(document.querySelectorAll('.datepicker'), {
            format: 'yyyy-mm-dd',
            autoClose: true
        });
        M.updateTextFields();
    }
    initMaterialize();

    // Dynamisches Formular für "IPads verwalten"
    const btnTrennen = document.getElementById('btn-trennen');
    const btnZuordnen = document.getElementById('btn-zuordnen');
    const btnZustand = document.getElementById('btn-zustand');
    const btnSubmit = document.getElementById('submit-action');
    const formTitle = document.getElementById('form-title');
    const formContent = document.getElementById('form-content');
    const outputIPad = document.getElementById('output-ipad');
    let currentAction = '';

    // Dynamisches Formular erstellen
    function updateForm(action) {
        currentAction = action;
        formContent.innerHTML = '';
        let formHTML = '';

        if (action === 'trennen') {
            formTitle.textContent = 'Schüler von IPad trennen';
            formHTML = `
                <div class="input-field">
                    <input id="ipad-number" type="text" placeholder="iPad-Nummer eingeben">
                    <label for="ipad-number">iPad-Nummer</label>
                </div>
                <div class="input-field">
                    <input id="student-number" type="text" placeholder="Schüler-ID eingeben">
                    <label for="student-number">Schüler-ID</label>
                </div>
                <div class="input-field">
                    <input id="datepicker2" type="text" class="datepicker" placeholder="Abgabe-Datum auswählen">
                    <label for="datepicker2">Abgabe-Datum</label>
                </div>
            `;
        } else if (action === 'zuordnen') {
            formTitle.textContent = 'IPad einem Schüler zuordnen';
            formHTML = `
                <div class="input-field">
                    <input id="ipad-number" type="text" placeholder="iPad-Nummer eingeben">
                    <label for="ipad-number">iPad-Nummer</label>
                </div>
                <div class="input-field">
                    <input id="student-number" type="text" placeholder="Schüler-ID eingeben">
                    <label for="student-number">Schüler-ID</label>
                </div>
                <div class="input-field">
                    <input id="ausgabe-datum" type="text" class="datepicker" placeholder="Ausgabe-Datum auswählen">
                    <label for="ausgabe-datum">Ausgabe-Datum</label>
                </div>
                <div class="input-field">
                    <input id="geplante-abgabe" type="text" class="datepicker" placeholder="Geplante Abgabe-Datum auswählen">
                    <label for="geplante-abgabe">Geplante Abgabe-Datum</label>
                </div>
            `;
        }

        formContent.innerHTML = formHTML;
        initMaterialize(); // Reinitialisieren
    }

    // Event-Listener für Buttons
    btnTrennen?.addEventListener('click', () => updateForm('trennen'));
    btnZuordnen?.addEventListener('click', () => updateForm('zuordnen'));

    // Formular senden im iPad-Verwalten-Tab
    btnSubmit?.addEventListener('click', function () {
        const ipadNumber = document.getElementById('ipad-number')?.value;
        const studentNumber = document.getElementById('student-number')?.value;

        if (currentAction === 'trennen') {
            const abgabeDatum = document.getElementById('datepicker2')?.value;

            if (!ipadNumber || !studentNumber || !abgabeDatum) {
                alert("Bitte alle Felder ausfüllen!");
                return;
            }
            sendRequest('ipadTrennen.php', { 
                tabletId: ipadNumber, 
                schuelerId: studentNumber, 
                abgabeDatum 
            }, outputIPad);
        } else if (currentAction === 'zuordnen') {
            const ausgabeDatum = document.getElementById('ausgabe-datum')?.value;
            const geplanteAbgabe = document.getElementById('geplante-abgabe')?.value;

            if (!ipadNumber || !studentNumber || !ausgabeDatum || !geplanteAbgabe) {
                alert("Bitte alle Felder ausfüllen!");
                return;
            }
            sendRequest('ipadZuordnen.php', { 
                tabletId: ipadNumber, 
                schuelerId: studentNumber, 
                ausgabeDatum, 
                geplanteAbgabe 
            }, outputIPad);
        }
    });

    // AJAX-Request senden
    function sendRequest(url, data, outputContainer) {
        $.ajax({
            url: url,
            method: 'POST',
            data: data,
            success: function (response) {
                outputContainer.innerHTML = `<p>${response}</p>`;
            },
            error: function (xhr, status, error) {
                console.error("Fehler:", status, error);
                outputContainer.innerHTML = `<p>Fehler: ${error}</p>`;
            }
        });
    }

    // History-Tab bleibt unangetastet
    const inputField = document.getElementById("search-input");
    const inputLabel = document.getElementById("search-label");
    const btnSchueler = document.getElementById("btn-schueler");
    const btnIpad = document.getElementById("btn-ipad");
    const refreshButton = document.getElementById("refreshhistory");
    const outputHistory = document.getElementById("output");

    let searchType = null;

    btnSchueler?.addEventListener("click", () => {
        searchType = 'schueler';
        inputField.disabled = false;
        inputField.placeholder = "Schüler oder Schülernummer eingeben...";
        inputLabel.style.display = "block";
    });

    btnIpad?.addEventListener("click", () => {
        searchType = 'ipad';
        inputField.disabled = false;
        inputField.placeholder = "iPad-Nummer eingeben...";
        inputLabel.style.display = "block";
    });

    refreshButton?.addEventListener("click", () => {
        const searchInput = inputField.value;
        const datepicker = document.getElementById("datepicker").value;

        if (!searchType || !searchInput || !datepicker) {
            alert("Bitte alle Felder ausfüllen!");
            return;
        }

        const url = searchType === 'schueler' ? 'sushistory.php' : 'tablethistory.php';
        sendRequest(url, { search: searchInput, date: datepicker }, outputHistory);
    });
    function loadAllTablets() {
        $.ajax({
            url: 'ipadsAnzeigen.php', 
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                let output = '<table class="striped">';
                output += '<thead><tr><th>TabletID</th><th>Modell</th><th>Zustand</th><th>Zubehör</th></tr></thead><tbody>';
                
                response.forEach(function (tablet) {
                    output += `
                        <tr>
                            <td>${tablet.TabletID}</td>
                            <td>${tablet.Modell}</td>
                            <td>${tablet.Zustand}</td>
                            <td>${tablet.Zubehoer ? tablet.Zubehoer : 'N/A'}</td>
                        </tr>
                    `;
                });
                
                output += '</tbody></table>';
                document.getElementById('outputAll').innerHTML = output;
            },
            error: function (xhr, status, error) {
                console.error("Fehler beim Abrufen der Daten:", status, error);
                document.getElementById('outputAll').innerHTML = `<p>Fehler: ${error}</p>`;
            }
        });
    }

    // Lade Daten beim Seitenaufruf
    loadAllTablets();
});

</script>
</body>
</html>

