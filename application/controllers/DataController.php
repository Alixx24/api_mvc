<?php

namespace App\Controllers;

use Application\Core\Controller;
use Application\Core\Database;
use Application\Model\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class DataController extends Controller
{
    public function fetchData()
    {
        $url = "https://jsonplaceholder.typicode.com/posts";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);

        curl_close($ch);

        if ($response === false || $httpCode !== 200) {
            echo "error fetching data: " . ($curlError ?: "HTTP status $httpCode");
            die;
        }

        $data = json_decode($response, true);

        $posts = array_slice($data, 0, 2);
        header('Content-Type: application/json');

        echo json_encode([
            'error' => false,
            'data' => $posts,
        ]);



        // foreach (array_slice($data, 0, 3) as $post) {
        //     echo "ID: " . $post['id'] . "<br>";
        //     echo "Title: " . $post['title'] . "<br>";
        //     echo "Body: " . $post['body'] . "<br><hr>";
        // }

        // die;
    }
}
