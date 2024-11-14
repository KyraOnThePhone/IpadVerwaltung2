<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ipad Verwaltung</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@materializecss/materialize@2.1.1/dist/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="style.css">

    </head>
    <body>
        <header>


            <nav>
                <div class="nav-wrapper deep-purple darken-3 ">
                  <a href="#!" class="brand-logo"><i class="material-icons">tablet_mac</i>IPad Verwaltung</a>
                  <ul class="right hide-on-med-and-down">
                    <li><i class="material-icons">account_box</i></li>
                    <li><?=htmlspecialchars($_SESSION['name'], ENT_QUOTES)?></li>
                    <li><a href="logout.php">Logout</a></li>
                </div>
              </nav>
        </header>
        <main>
        <div class="container">
            <ul id="tabs-swipe-demo" class="tabs">
                <li class="tab col s3"><a href="#test-swipe-1">Test 1</a></li>
                <li class="tab col s3"><a href="#test-swipe-2">Test 2</a></li>
                <li class="tab col s3"><a href="#test-swipe-3">Test 3</a></li>
            </ul>

            <div id="test-swipe-1" class="col s12 blue white-text">Test 1 Inhalt</div>
            <div id="test-swipe-2" class="col s12 red white-text">Test 2 Inhalt</div>
            <div id="test-swipe-3" class="col s12 green white-text">Test 3 Inhalt</div>
        </div>
        </main>
        <footer>

        </footer>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/@materializecss/materialize@2.1.1/dist/js/materialize.min.js"></script>
   <script>
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('.tabs');
             M.Tabs.init(elems, {
                swipeable: true 
            });
        });


</script>
</scrip>
</html>
