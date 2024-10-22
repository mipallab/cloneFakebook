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

        foreach ($like2['replay'] as &$replay_like_count) {
            echo "<pre>";
            print_r($replay_like_count);

            if ($replay_like_count['id'] == $likeId) {
                $previous_value = $replay_like_count['like'];
                $replay_like_count['like'] = $previous_value + 1;
            }
        }
    }
}


file_put_contents("db/data.json", json_encode($likeData));

header("location: index.php");