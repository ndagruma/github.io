<?php
    $file = 'urls.txt';

    function getShortUrl($longUrl, $id) {
        $urls = array(
            'id' => $id,
            'longUrl' => $longUrl,
            'shortUrl' => 'https://testwebsiteelf.000webhostapp.com/' . $id
        );
        return $urls;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $longUrl = $_POST['longUrl'];
        $id = uniqid();
        $shortUrl = getShortUrl($longUrl, $id);

        file_put_contents($file, json_encode($shortUrl) . PHP_EOL, FILE_APPEND);

        echo json_encode(array('shortUrl' => $shortUrl['shortUrl']));
        exit;
    } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $id = $_GET['id'];
        $lines = file($file);
        foreach ($lines as $line) {
            $urls = json_decode($line, true);
            if ($urls['id'] == $id) {
                header("Location: " . $urls['longUrl']);
                exit;
            }
        }
        http_response_code(404);
    }
    $short_url = $_GET['short'];

// Read the urls from the urls.txt file
$urls = file('urls.txt', FILE_IGNORE_NEW_LINES);

// Find the original URL for the short URL
$long_url = "";
foreach ($urls as $url) {
  $parts = explode(" ", $url);
  if ($parts[0] == $short_url) {
    $long_url = $parts[1];
    break;
  }
}
?>

