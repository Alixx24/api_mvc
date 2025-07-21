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

  public function searchData()
{
   
    $url = "https://jsonplaceholder.typicode.com/posts";

    // مقدار search رو از query string می‌گیریم
    $searchTerm = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : null;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);

    curl_close($ch);

    header('Content-Type: application/json');

    if ($response === false || $httpCode !== 200) {
        http_response_code(500);
        echo json_encode([
           'error' => true,
        'message' => 'پارامتر search ارسال نشده است.',
        'data' => []
        ]);
        return;
    }

    $data = json_decode($response, true);

    // اگر search وارد شده بود، فیلتر کن
    if ($searchTerm) {
        $data = array_filter($data, function ($post) use ($searchTerm) {
            return strpos(strtolower($post['title']), $searchTerm) !== false ||
                   strpos(strtolower($post['body']), $searchTerm) !== false;
        });

        // اندیس‌های آرایه رو دوباره مرتب می‌کنیم
        $data = array_values($data);
    }

    echo json_encode([
        'error' => false,
        'data' => array_slice($data, 0, 10), // فقط ۱۰ مورد اول برای بهینه بودن
    ]);
}

public function getPostsSimple()
{
    $url = "https://jsonplaceholder.typicode.com/posts";

    $options = [
        "http" => [
            "method" => "GET",
            "header" => "Accept: application/json\r\n",
            "timeout" => 5
        ]
    ];

    $context = stream_context_create($options);
    $response = @file_get_contents($url, false, $context);

    header('Content-Type: application/json');

    if ($response === false) {
        echo json_encode([
            'error' => true,
            'message' => 'خطا در دریافت داده‌ها',
        ]);
        return;
    }

    $data = json_decode($response, true);

    $posts = array_slice($data, 0, 2);

    echo json_encode([
        'error' => false,
        'data' => $posts,
    ]);
}


public function searchPostsSimple()
{
    $url = "https://jsonplaceholder.typicode.com/posts";

  
    $searchTerm = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : null;

    $options = [
        "http" => [
            "method" => "GET",
            "header" => "Accept: application/json\r\n",
            "timeout" => 5
        ]
    ];

    $context = stream_context_create($options);
    $response = @file_get_contents($url, false, $context);

    header('Content-Type: application/json');

    if ($response === false) {
        http_response_code(500);
        echo json_encode([
            'error' => true,
            'message' => 'خطا در دریافت داده‌ها',
            'data' => []
        ]);
        return;
    }

    $data = json_decode($response, true);

    if ($searchTerm) {
        $data = array_filter($data, function ($post) use ($searchTerm) {
            return strpos(strtolower($post['title']), $searchTerm) !== false ||
                   strpos(strtolower($post['body']), $searchTerm) !== false;
        });
        $data = array_values($data);
    }

    echo json_encode([
        'error' => false,
        'data' => array_slice($data, 0, 10),
    ]);
}



}
