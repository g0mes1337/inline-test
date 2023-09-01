<?php

require_once 'php/DB.php';

class Downloader
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    function loadData($url)
    {
        $data = file_get_contents($url);
        return json_decode($data, true);
    }

    function loadIntoDB($posts, $comments)
    {
        $posts = $this->loadData($posts);
        $comments = $this->loadData($comments);

        foreach ($posts as $post) {
            $query = "INSERT INTO posts ( user_id, title, body)
            VALUES ( {$post['userId']}, '{$post['title']}', '{$post['body']}')";
            $this->conn->getConnection()->query($query);;
        }

        foreach ($comments as $comment) {
            $this->conn->getConnection()->query("INSERT INTO comments ( post_id, name, email, body)
          VALUES ({$comment['postId']}, '{$comment['name']}', '{$comment['email']}', '{$comment['body']}')");
        }
        return "Загружено " . count($posts) . " записей и " . count($comments) . " комментариев";
    }
}