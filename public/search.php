<?php
if (!isset($_GET['query']) || strlen($_GET['query']) < 3) {
    echo "Введите минимум 3 символа для поиска.";
    exit;
}

$query = '%' . $_GET['query'] . '%';

$pdo = new PDO('mysql:host=localhost;dbname=blog_data;charset=utf8', 'root', '');

$sql = "
    SELECT posts.title, comments.body
    FROM comments
    JOIN posts ON comments.post_id = posts.id
    WHERE comments.body LIKE ?
";
$stmt = $pdo->prepare($sql);
$stmt->execute([$query]);

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$results) {
    echo "Ничего не найдено.";
} else {
    echo "<h2>Результаты поиска:</h2>";
    foreach ($results as $row) {
        echo "<h3>{$row['title']}</h3>";
        echo "<p><em>{$row['body']}</em></p><hr>";
    }
}
?>
