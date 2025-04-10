<?php
if (!isset($_GET['title'])) {
    echo json_encode(['error' => 'No title provided']);
    exit;
}

$title = urlencode($_GET['title']);
$apiUrl = "https://www.googleapis.com/books/v1/volumes?q=" . $title;

$response = file_get_contents($apiUrl);
$data = json_decode($response, true);

$results = [];

if (isset($data['items'])) {
    foreach ($data['items'] as $item) {
        $volume = $item['volumeInfo'];
        $link = $volume['infoLink'] ?? '#';
        $title = $volume['title'] ?? 'Unknown';
        $authors = isset($volume['authors']) ? implode(", ", $volume['authors']) : 'Unknown';
        $results[] = [
            'title' => $title,
            'authors' => $authors,
            'link' => $link
        ];
    }

    
}

header('Content-Type: application/json');
echo json_encode($results);
