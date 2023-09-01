<?php

require_once 'php/DB.php';

class Search
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function renderForm()
    {
        echo '
      <form method="GET" action="search.php">
        <input type="text" name="query" placeholder="Введите текст комментария (минимум 3 символа)">
        <button type="submit">Найти</button>
      </form>
    ';
    }

    public function search($query)
    {
        if (strlen($query) >= 3) {
            $conn = $this->conn->getConnection();
            mysqli_select_db($this->conn->getConnection(), "inline");

            $result = $conn->query("SELECT posts.title, comments.body FROM posts
              INNER JOIN comments ON posts.id = comments.post_id
              WHERE comments.body LIKE '%$query%'");

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<h3>" . $row['title'] . "</h3>";
                    echo "<p>" . $row['body'] . "</p>";
                    echo "<br/>";
                }
            } else {
                echo "По вашему запросу ничего не найдено.";
            }
        } else {
            echo "Введите минимум 3 символа для поиска.";
        }
    }

}