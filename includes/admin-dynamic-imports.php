<?php
    
    include '../includes/cachebust.php';

    // These are for css files
    $cssPaths = array(
        '../assets/css/home/old-styles.css',
        '../assets/css/home/index.css',
        '../assets/css/home/header.css',
        '../assets/css/home/main.css',
        '../assets/css/home/sidenavigation.css',
        '../assets/css/home/tab-card.css',
        '../assets/css/home/chat.css',
        '../assets/css/home/grade-cards.css',
        '../assets/css/home/footer.css',
        '../assets/css/home/table.css',

        '../assets/css/pdf-viewer.css',
        '../assets/css/tab.css',
        '../assets/css/dialogs.css',
        '../assets/css/translation.css',
        '../assets/css/batch-select.css',
        '../assets/css/dropdown.css',
        '../assets/css/profile.css',
        '../assets/css/spinkit.css'
    );

    // These are for javascript files that you want
    // to run immediately before the page loads
    $jsPaths = array(
        '../assets/js/dialogs.js',
        '../assets/js/functions.js',
    );

    // These are for javascript files that you want
    // to run when the page completes loading.
    $jsPaths_Defer = array(
        '../assets/js/tab.js',
        '../assets/js/sidebar.js',
        '../assets/js/dropdown.js',
        '../assets/js/admin/index.js',
        '../assets/js/pdf-viewer.js',
        '../assets/js/logoutDialogListener.js',
        '../assets/js/admin/weightAssignments.js'
    );

    foreach ($cssPaths as $path) {
        echo "<link rel='stylesheet' href='" .$path. "?" .cachebust($path). "'>";
    }

    foreach ($jsPaths as $path) {
        echo "<script src='" .$path. "?" .cachebust($path). "'></script>";
    }

    foreach ($jsPaths_Defer as $path) {
        echo "<script src='" .$path. "?" .cachebust($path). "' defer></script>";
    }

?>