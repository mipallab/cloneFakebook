<?php
// require function.php
if (file_exists(__DIR__ . "/apps/functions.php")) {
    require_once __DIR__ . "/apps/functions.php";
} else {
    echo "<b>functions.php </b> file not found";
}

// require model.php
if (file_exists(__DIR__ . "/apps/model.php")) {
    require_once __DIR__ . "/apps/model.php";
} else {
    echo "<b>model.php </b> file not found";
}
