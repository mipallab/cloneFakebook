<?php

// require function.php
if (file_exists(__DIR__ . "/autoload.php")) {
    require_once __DIR__ . "/autoload.php";
} else {
    echo "<b>autoload.php </b> file not found";
}

$deleteId = $_GET['delete_id'] ?? null;

remove($deleteId, 'db/data.json');

header("location: index.php");
