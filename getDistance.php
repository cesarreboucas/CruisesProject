<?php

require_once('inc/config.inc.php'); // Config
require_once('inc/utilities/RestClient.class.php'); // API
if(isset($_GET['a']) && isset($_GET['b'])) {
    $json = json_decode(RestClient::call('GET', array('stops' => $_GET['a'].'|'.$_GET['b'])));
    //var_dump($json->distance);
    if(is_int($json->distance) && $json->distance!=0) {
        echo $json->distance.' Km';
    } else {
        echo 'Unavailable';
    }
} else {
    echo 'Unavailable';
}





?>