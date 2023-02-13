<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/Progetto-finale/Gestione-prenotazioni/index' :
        require __DIR__ . '/views/controlPanel.php';
        break;
    case '/Progetto-finale/Gestione-prenotazioni/controlpanel' :
        require __DIR__ . '/views/controlPanel.php';
        break;
    case '/Progetto-finale/Gestione-prenotazioni/reservation' :
        require __DIR__ . '/views/reservation.php';
        break;
    case '/Progetto-finale/Gestione-prenotazioni/room1' :
        require __DIR__ . '/views/room1.php';
        break;
    case '/Progetto-finale/Gestione-prenotazioni/room2' :
        require __DIR__ . '/views/room2.php';
        break;
    case '/Progetto-finale/Gestione-prenotazioni/room3' :
        require __DIR__ . '/views/room3.php';
        break;
    case '/Progetto-finale/Gestione-prenotazioni/customerlist' :
        require __DIR__ . '/views/customerlist.php';
        break;
    case '/Progetto-finale/Gestione-prenotazioni/customeradd' :
        require __DIR__ . '/views/customeradd.php';
        break;
    default:
        require __DIR__ . '/views/404.php';
        break;
}