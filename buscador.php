<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<?php 

$dir = 'C:\xampp\htdocs\gamera\1';
$files = scandir($dir);

$pages = [];

foreach ($files as $file) {
  if (strpos($file, '.html') !== false) {
    $path = $dir . '/' . $file;
    $html = file_get_contents($path);
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    $title = $dom->getElementsByTagName('title')->item(0)->textContent;
    $content = $dom->getElementsByTagName('body')->item(0)->textContent;
    $page = ['title' => $title, 'content' => $content, 'file' => $file];
    $pages[] = $page;
  }
}

$query = $_GET['q'];

$results = [];

foreach ($pages as $page) {
  if (preg_match('/' . $query . '/i', $page['content'])) {
    $results[] = $page;
  }
}

if (count($results) > 0) {
    echo '<ul>';
    foreach ($results as $result) {
      echo '<li>' . $result['title'] . ' - <a href="1/' . $result['file'] . '">' . $result['file'] . '</a></li>';
    }
    echo '</ul>';
  } else {
    echo 'No se encontraron';

  }

  ?>