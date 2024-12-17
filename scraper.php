<?php
require 'vendor/autoload.php';
use Goutte\Client;

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

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['url'])) {
    $nextUrl = $_GET['url'];
} else {
    $nextUrl = 'https://books.toscrape.com/catalogue/page-1.html'; 
}

function scrapePage($url, $client, $pdo, &$productCount) {
    $crawler = $client->request('GET', $url);
    
    $crawler->filter('.product_pod')->each(function ($node) use ($pdo, &$productCount) {
        if ($productCount < 200) {
            $title = $node->filter('.image_container img')->attr('alt');
            $price = $node->filter('.price_color')->text();
            $rating = $node->filter('p.star-rating')->attr('class');
            $rating = str_replace('star-rating', '', $rating);

            $stmt = $pdo->prepare("INSERT INTO products (title, price, rating) VALUES (:title, :price, :rating)");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':rating', $rating);
            $stmt->execute();

            $productCount++;
        }
    });

    try {
        $next_page = $crawler->filter('.next > a')->attr('href');
    } catch (InvalidArgumentException $e) {
        return NULL; 
    }

    return "https://books.toscrape.com/catalogue/" . $next_page;
}

$client = new Client();
$productCount = 0;

if ($nextUrl == 'https://books.toscrape.com/catalogue/page-1.html') {
    while ($nextUrl && $productCount < 200) {
        $nextUrl = scrapePage($nextUrl, $client, $pdo, $productCount);
    }

    header('Location: product-list.php');
    exit;
} else {
    echo "Invalid URL";
}
?>
