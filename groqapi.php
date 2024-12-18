<?php

require 'vendor/autoload.php';

$host = 'localhost';
$db = 'scraping_data'; 
$user = 'root'; 
$pass = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

$stmt = $pdo->query("SELECT CONCAT('[', GROUP_CONCAT(
                            JSON_OBJECT('title', title, 'price', price, 'rating', rating)
                        ), ']') AS products_json
                        FROM products;");
$products = $stmt->fetch(PDO::FETCH_ASSOC);
$productdata_json = $products['products_json'];


$apiUrl = 'https://api.groq.com/openai/v1/chat/completions';

$postData = [
    'model' => 'llama3-8b-8192',  
    'messages' => [
        ['role' => 'system', 'content' => 'Prompt: Based on the json data provide summarize key product attribute and highlight the trend'],
        ['role' => 'user', 'content' => $productdata_json]
    ],
    'temperature' => 0.7,
    'max_tokens' => 1024,
    'top_p' => 1.0,
    'frequency_penalty' => 0.0,
    'presence_penalty' => 0.0
];

$jsonData = json_encode($postData);


$headers = [
    "Content-Type: application/json",
    "Authorization: Bearer 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",  
];

$ch = curl_init($apiUrl);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

$response = curl_exec($ch);

if(curl_errno($ch)) {
    echo 'cURL Error: ' . curl_error($ch);
} else {
    $responseData = json_decode($response, true);
    echo $responseData['choices'][0]['message']['content'];
}

curl_close($ch);
?>
