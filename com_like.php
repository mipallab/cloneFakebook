<?php
if (file_exists(__DIR__ . "/autoload.php")) {
    require_once __DIR__ . "/autoload.php";
} else {
    echo "<b>autoload.php </b> file not found";
}

$likeId = $_GET['like_id'] ?? null;
$likeData = json_decode(file_get_contents("db/data.json"), true);


// like feature
foreach ($likeData as &$like1) {

    foreach ($like1['comments'] as &$like2) {

        if ($like2['id'] == $likeId) {

            $previous_value = $like2['like'];
            $like2['like'] = $previous_value + 1;
        }
    }
}


file_put_contents("db/data.json", json_encode($likeData));

header("location: index.php");