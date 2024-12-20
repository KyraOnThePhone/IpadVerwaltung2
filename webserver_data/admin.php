<?php
include 'sessioncheck.php';
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ipad Verwaltung</title>
 
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

            
            <div id="test-swipe-1" class="col s12 container deep-purple lighten-4 white-text swipeTabs">
    <button id="btn-verloren" class="btn deep-purple darken-3">verlorene IPads</button>
    <button id="btn-gut" class="btn deep-purple darken-3">IPads mit gutem Zustand</button>
    <button id="btn-schlecht" class="btn deep-purple darken-3">IPads mit schlechtem Zustand</button>
    <button id="btn-gebraucht" class="btn deep-purple darken-3">IPads mit gebrauchtem Zustand</button>
    <button id="btn-verliehen" class="btn deep-purple darken-3">verliehene IPads</button>
    <button id="btn-frei" class="btn deep-purple darken-3">freie IPads</button>

    <div class="input-field col s12">
        <select id="form-select-1">
            <option value="">alle Klassen</option>
        </select>
        <label for="form-select-1">IPads dieser Klasse anzeigen:</label>
    </div>
    <div>
        <button id="btn-refreshFilter" class="btn deep-purple darken-3"><i class="material-icons">refresh</i></button>
    </div>
    <div id="outputFilter" class="output-container" style="margin-top: 20px;"></div>
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Materialize-Komponenten initialisieren
    function initMaterialize() {
        M.FormSelect.init(document.querySelectorAll('select'));
        M.Datepicker.init(document.querySelectorAll('.datepicker'), {
            format: 'yyyy-mm-dd',
            autoClose: true
        });
        M.updateTextFields();
    }
    M.Tabs.init(document.querySelectorAll('.tabs'), { swipeable: true });
    initMaterialize();

    // Variablen für Tabs und Filter
    const inputField = document.getElementById("search-input");
    const refreshHistoryBtn = document.getElementById("refreshhistory");
    const outputHistory = document.getElementById('output');
    const outputFilter = document.getElementById('outputFilter');
    const outputAll = document.getElementById('outputAll');
    const btnRefreshFilter = document.getElementById('btn-refreshFilter');
    const selectKlasse = document.getElementById('form-select-1');
    const btnSubmit = document.getElementById('submit-action');
    const outputIPad = document.getElementById('output-ipad');
    let searchType = null;
    let currentFilter = { script: '', param: '' };

   
     //Universelle AJAX-Funktion für alle Tabs
    
    btnSubmit?.addEventListener('click', () => {
    const currentAction = formTitle.textContent.trim();
    let data = {}, url = '';

    if (currentAction.includes('trennen')) {
        url = 'ipadTrennen.php';
        data = {
            tabletId: document.getElementById('ipad-number')?.value,
            schuelerId: document.getElementById('student-number')?.value,
            abgabeDatum: document.getElementById('datepicker2')?.value
        };
    } else if (currentAction.includes('zuordnen')) {
        url = 'ipadZuordnen.php';
        data = {
            tabletId: document.getElementById('ipad-number')?.value,
            schuelerId: document.getElementById('student-number')?.value,
            ausgabeDatum: document.getElementById('ausgabe-datum')?.value,
            geplanteAbgabe: document.getElementById('geplante-abgabe')?.value
        };
    } else if (currentAction.includes('Zustand')) {
        const zustand = document.getElementById('zustand-select')?.value;

        // URL geändert je nach ausgewähltem Zustand
        switch (zustand) {
            case 'gut':
                url = 'zustandGut.php';
                break;
            case 'gebraucht':
                url = 'zustandGebraucht.php';
                break;
            case 'schlecht':
                url = 'zustandSchlecht.php';
                break;
            case 'verloren':
                url = 'verloren.php';
                break;
            default:
                alert("Ungültiger Zustand ausgewählt.");
                return;
        }

        data = {
            tabletId: document.getElementById('ipad-number')?.value
        };
    }

    // AJAX-Anfrage senden
    if (url) {
        sendRequest(url, data, outputIPad);
    }
});

    function sendRequest(url, data, outputContainer) {
    console.log("Sende Anfrage an:", url, "mit Daten:", data);
    $.ajax({
        url: url,
        method: 'POST',
        data: data,
        dataType: 'json', // Serverantwort als JSON
        success: function (response) {
            console.log("Antwort erhalten:", response);

            if (response.success) {
                // Erfolgsmeldung
                outputContainer.innerHTML = `<p>${response.success}</p>`;
            } else if (response.error) {
                // Fehlermeldung
                outputContainer.innerHTML = `<p>Fehler: ${response.error}</p>`;
            } else if (Array.isArray(response) && response.length > 0) {
                // JSON-Daten in HTML-Tabelle umwandeln
                let tableHTML = '<table class="striped centered"><thead><tr>';
                Object.keys(response[0]).forEach(key => {
                    tableHTML += `<th>${key}</th>`;
                });
                tableHTML += '</tr></thead><tbody>';

                response.forEach(row => {
                    tableHTML += '<tr>';
                    Object.values(row).forEach(value => {
                        tableHTML += `<td>${value}</td>`;
                    });
                    tableHTML += '</tr>';
                });
                tableHTML += '</tbody></table>';

                // Tabelle in den Container einfügen
                outputContainer.innerHTML = tableHTML;
            } else {
               
                outputContainer.innerHTML = '<p>Keine Daten gefunden.</p>';
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Fehler:", error);
            outputContainer.innerHTML = `<p>Fehler: ${error}</p>`;
        }
    });
}


    // History-Tab Logik
    document.getElementById("btn-schueler")?.addEventListener("click", () => setupSearch('schueler', "Schülernummer eingeben..."));
    document.getElementById("btn-ipad")?.addEventListener("click", () => setupSearch('ipad', "iPad-Nummer eingeben..."));
    refreshHistoryBtn?.addEventListener("click", () => {
        if (!searchType || !inputField.value) {
            alert("Bitte Nummer und Datum eingeben.");
            return;
        }
        sendRequest(
            searchType === 'schueler' ? 'sushistory.php' : 'tablethistory.php',
            { search: inputField.value, date: document.getElementById("datepicker").value },
            outputHistory
        );
    });

    function setupSearch(type, placeholder) {
        searchType = type;
        inputField.disabled = false;
        inputField.placeholder = placeholder;
    }

    //Filter-Buttons
    document.querySelectorAll('#btn-verloren, #btn-gut, #btn-schlecht, #btn-gebraucht, #btn-verliehen, #btn-frei')
        .forEach(button => {
            button.addEventListener('click', () => {
                currentFilter.script = button.id.includes('status') ? 'statusAnzeigen.php' : 'zustandAnzeigen.php';
                currentFilter.param = button.id.split('-')[1]; // "gut", "schlecht", etc.
                outputFilter.innerHTML = `<p>Filter eingestellt: ${currentFilter.param}</p>`;
            });
        });

    btnRefreshFilter?.addEventListener("click", () => {
        if (!currentFilter.script) {
            alert("Bitte zuerst einen Filter auswählen.");
            return;
        }
        sendRequest(currentFilter.script, { zustand: currentFilter.param, klasse: selectKlasse.value }, outputFilter);
    });

    //Alle IPads anzeigen
    sendRequest('ipadsAnzeigen.php', {}, outputAll);

    //Dynamisches iPad-Verwalten-Formular
    const formContent = document.getElementById('form-content');
    const formTitle = document.getElementById('form-title');
    document.getElementById('btn-trennen')?.addEventListener('click', () => updateForm('trennen'));
    document.getElementById('btn-zuordnen')?.addEventListener('click', () => updateForm('zuordnen'));
    document.getElementById('btn-zustand')?.addEventListener('click', () => updateForm('zustand'));

    btnSubmit?.addEventListener('click', () => {
        const currentAction = formTitle.textContent.trim();
        let data = {}, url = '';
        if (currentAction.includes('trennen')) {
            url = 'ipadTrennen.php';
            data = {
                tabletId: document.getElementById('ipad-number')?.value,
                schuelerId: document.getElementById('student-number')?.value,
                abgabeDatum: document.getElementById('datepicker2')?.value
            };
        } else if (currentAction.includes('zuordnen')) {
            url = 'ipadZuordnen.php';
            data = {
                tabletId: document.getElementById('ipad-number')?.value,
                schuelerId: document.getElementById('student-number')?.value,
                ausgabeDatum: document.getElementById('ausgabe-datum')?.value,
                geplanteAbgabe: document.getElementById('geplante-abgabe')?.value
            };
        } else if (currentAction.includes('Zustand')) {
            url = 'zustandAnpassen.php';
            data = {
                tabletId: document.getElementById('ipad-number')?.value,
                zustand: document.getElementById('zustand-select')?.value
            };
        }
        sendRequest(url, data, outputIPad);
    });

    function updateForm(action) {
        let formHTML = '';
        if (action === 'trennen') {
            formTitle.textContent = 'Schüler von IPad trennen';
            formHTML = `<input id="ipad-number" type="text" placeholder="iPad-Nummer"><input id="student-number" type="text" placeholder="Schüler-ID"><input id="datepicker2" type="text" class="datepicker" placeholder="Abgabe-Datum">`;
        } else if (action === 'zuordnen') {
            formTitle.textContent = 'IPad einem Schüler zuordnen';
            formHTML = `<input id="ipad-number" type="text" placeholder="iPad-Nummer"><input id="student-number" type="text" placeholder="Schüler-ID"><input id="ausgabe-datum" type="text" class="datepicker" placeholder="Ausgabe-Datum"><input id="geplante-abgabe" type="text" class="datepicker" placeholder="Geplante Abgabe-Datum">`;
        } else if (action === 'zustand') {
            formTitle.textContent = 'Zustand des IPads ändern';
            formHTML = `<input id="ipad-number" type="text" placeholder="iPad-Nummer"><select id="zustand-select"><option value="" disabled selected>Zustand auswählen</option><option value="gut">Gut</option><option value="gebraucht">Gebraucht</option><option value="schlecht">Schlecht</option><option value="verloren">Verloren</option></select>`;
        }
        formContent.innerHTML = formHTML;
        initMaterialize();
    }

    //Dynamisch Klassen laden
    $.ajax({
        url: 'Klassen.php',
        method: 'GET',
        dataType: 'json',
        success: (response) => {
            response.forEach(klasse => {
                const option = document.createElement('option');
                option.value = klasse.Klasse;
                option.textContent = `Klasse ${klasse.Klasse}`;
                selectKlasse.appendChild(option);
            });
            initMaterialize();
        },
        error: () => console.error('Fehler beim Laden der Klassen.')
    });
});


</script>
</body>
</html>

