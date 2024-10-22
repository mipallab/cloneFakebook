<?php
date_default_timezone_set("Asia/Dhaka");
/**
 * @param alert alert massage
 * @param  type {alert type (warning, success, danger}
 */
function alert(string $msg, string $type = "warning")
{

    return "<div class='alert alert-{$type} alert-dismissible fade show' role='alert'>
        {$msg}
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
}


/**
 * Time ago function
 * @param timestamp
 */

function timeAgo($timestamp)
{
    $created_at = strtotime($timestamp);
    $current_time = time();

    $post_time = $current_time - $created_at;

    //minute
    $min = round($post_time / 60);
    //Hour
    $hour = round($min / 60);
    //Day
    $day = round($hour / 24);
    // week
    $week = round($day / 7);
    // month
    $month = round($day / 30);
    // year
    $year = round($month / 12);


    //time ago condition
    if ($post_time < 60) {
        return "Just Now";
    } else if ($min < 60) {
        return ($min == 1) ? "{$min} min ago"
            : "{$min} mins ago";
    } else if ($hour < 24) {
        return ($hour == 1) ? "{$hour} hour ago" : "{$hour} hours ago";
    } else
    if ($day < 7) {
        return ($day == 1) ? "{$day} day ago" : "{$day} days ago";
    } else if ($week < 4) {
        return ($week == 1)
            ? "{$week} week ago" : "{$week} weeks ago";
    } else if ($month < 12) {
        return ($month == 1) ? "{$month} month ago"
            : "{$month} month ago";
    } else {
        return "{$year} year ago";
    }
}

/**
 * move all flles
 */
function move(array $file_name, string $path, array $support_files)
{
    $name = $file_name['name'];   // get file name
    $tmp = $file_name['tmp_name'];  // get file tmp_name

    $file_exe = explode(".", $name);
    $file_exe_lower = strtolower(end($file_exe));

    if (in_array($file_exe_lower, $support_files)) {
        $unique_name = time() . "_" . rand() . "_" . str_shuffle("1234567890") . "." . $file_exe_lower;
        move_uploaded_file($tmp, $path . $unique_name);
        return $unique_name;
    } else {
        return "bhul";
    }
}

/**
 * Unique id Generator
 */
function g_id(string $name)
{
    $id = $name . time() . rand() . str_shuffle("1234567890");

    return $id;
}
