<?php

/**
 * @param $path
 * @param $pushData
 */

function upload(string $path, array $pushData)
{
    $data = json_decode(file_get_contents($path), true);
    array_push($data, $pushData);
    file_put_contents($path, json_encode($data));
}

/**
 * @param $path
 * @param $isarray
 */

function all(string $path, bool $isArray)
{
    $data = json_decode(file_get_contents($path), $isArray);
    return $data;
}


/**
 *  Delete/Remove Data
 */

function remove(string $find_id, string $path)
{
    //find all data
    $users = json_decode(file_get_contents($path), true);

    foreach ($users as $key => $remove_user) {
        if ($remove_user['id'] ==  $find_id) {
            unset($users[$key]);
            break;
        }
    }

    file_put_contents($path, json_encode($users));
}