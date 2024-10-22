<?php

session_start();
// require function.php
if (file_exists(__DIR__ . "/autoload.php")) {
    require_once __DIR__ . "/autoload.php";
} else {
    echo "<b>autoload.php </b> file not found";
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['comment-submit'])) {
    // get comment data
    $comm_user_name = $_POST['comm_usr_name'];
    $comm_content = $_POST['comment-content'];
    $post_id = $_POST['post_id'];

    // get files data
    $comm_user_photo = $_FILES['comment_pro_photo'];
    $comm_photo = $_FILES['comment-photos'];


    if (!empty($comm_user_name) && (!empty($comm_content) || !empty($comm_photo['name']))) {

        //upload user photo
        $com_use_photo = move($comm_user_photo, "assets/images/users/", ['jpg', 'png', 'jpeg']);

        //upload comment photo
        $com_photo = move($comm_photo, "assets/images/comment-photo/", ['jpg', 'png', 'jpeg']);

        /**
         * commnet 
         *  
         * */

        $comAllData = all('db/data.json', true);    // get all data

        $com_new_ary = [];
        foreach ($comAllData as $com_item) {

            // filter post
            if ($com_item['id'] == $post_id) {
                array_push($com_item['comments'], [
                    'id'            => g_id("COM"),
                    'user_name'     => $comm_user_name,
                    'content'       => $comm_content ?? '',
                    'user_photo'    => $com_use_photo ?? '',
                    'comment_photo' => $com_photo ?? '',
                    'like'          => 0,
                    'replay'        => [],
                    "created_at"    => date("YmdHis")
                ]);
            }
            array_push($com_new_ary, $com_item);
        }
        file_put_contents('db/data.json', json_encode($com_new_ary));
    } else {
        $_SESSION['comment_alert'] =  alert("<b>Comment text</b> or <b>Comment photo</b> require", "danger");
    }


    header("location: index.php");
}