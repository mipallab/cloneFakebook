<?php

session_start();
// require function.php
if (file_exists(__DIR__ . "/autoload.php")) {
    require_once __DIR__ . "/autoload.php";
} else {
    echo "<b>autoload.php </b> file not found";
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['comment-replay-submit'])) {
    // get comment data
    $comm_replay_user_name = $_POST['comm_rep_usr_name'];
    $comm_replay_content = $_POST['comment-rep-content'];
    $comment_id = $_POST['com_id'];

    // get files data
    $comm_replay_user_photo = $_FILES['comment_rep_usr_photo'];
    $comm_replay_photo = $_FILES['comment-rep-photos'];


    if (!empty($comm_replay_user_name) && (!empty($comm_replay_content) || !empty($comm_replay_photo['name']))) {

        //upload user photo
        $com_use_photo = move($comm_replay_user_photo, "assets/images/users/", ['jpg', 'png', 'jpeg']);

        //upload comment photo
        $com_photo = move($comm_replay_photo, "assets/images/comment-photo/", ['jpg', 'png', 'jpeg']);

        /**
         * commnet 
         *  
         * */

        $comAllData = all('db/data.json', true);    // get all data
        // echo "<h2>Prothom</h2>";
        foreach ($comAllData as &$comData_item) {

            foreach ($comData_item['comments'] as &$replay_comment_item) {

                if ($replay_comment_item['id'] == $comment_id) {

                    echo "<pre>";
                    print_r($replay_comment_item['replay']);

                    array_push($replay_comment_item['replay'], [
                        'id'            => g_id("REP-COM-"),
                        'user_name'     => $comm_replay_user_name ?? '',
                        'content'       => $comm_replay_content ?? '',
                        'user_photo'    => $com_use_photo ?? '',
                        'comment_photo' => $com_photo ?? '',
                        'like'          => 0,
                        'created_at'    => date("YmdHis")
                    ]);
                    echo "<h2> After REplay comment data </h2>";
                    echo "<pre>";
                    print_r($replay_comment_item['replay']);
                }
            }
        }

        file_put_contents('db/data.json', json_encode($comAllData));
    } else {
        $_SESSION['comment_alert'] =  alert("<b>Comment text</b> or <b>Comment photo</b> require", "danger");
    }

    header("location: index.php");
}