<?php

require_once 'php/DB.php';
require_once 'php/Downloader.php';
require_once 'php/Search.php';


$database = new DB();

$connection = $database->getConnection();

$sqlContent = file_get_contents('./database.sql');

$queries = explode(';', $sqlContent);

foreach ($queries as $query) {
    if (trim($query)) {
        $connection->query($query);
    }
}

mysqli_select_db($database->getConnection(), "inline");
$dataDownloader = new Downloader($database);

$dataDownloader->loadIntoDB('https://jsonplaceholder.typicode.com/posts',
    'https://jsonplaceholder.typicode.com/comments');

function fetchRow($result)
{
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['count'];
    }
}

$postCount = fetchRow($database->getConnection()->query("SELECT COUNT(*) AS count FROM posts"));

$commentCount = fetchRow($database->getConnection()->query("SELECT COUNT(*) AS count FROM comments"));

echo "Загружено $postCount записей и $commentCount комментариев";
$searchForm = new Search($database);
$searchForm->renderForm();
