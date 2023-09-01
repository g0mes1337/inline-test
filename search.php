<?php
require_once 'php/DB.php';
require_once 'php/Search.php';

$database = new DB();

$query = isset($_GET['query']) ? $_GET['query'] : '';
$searchForm = new Search($database);
$searchForm->search($query);
