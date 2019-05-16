<?php

/* Done in class */

class RestClient {
    // Calls the API
    static function call($method, $callData) {
        $requestHeader = array('requesttype' => $method);
        $data = array_merge($requestHeader,$callData);

        $options = array(
            'https' => array(
                'header' => 'Content-Type: application/x-www-form-urlencoded\r\n',
                'method' => $method,
                'content' => http_build_query($data)
            )
        );
        //var_dump($options);
        $context = stream_context_create($options);
        $result = file_get_contents(API_URL . '?' . http_build_query($callData) , false, $context);
        return $result;
    }
}

?>