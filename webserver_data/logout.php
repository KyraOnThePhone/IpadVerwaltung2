<?php
session_start();
session_destroy();
// Weiterleitung zur Startseite
header('Location: index.html');
