<?php
$pdo = new PDO('mysql:host=localhost;dbname=blog_data;charset=utf8', 'root', ''); // Убедитесь, что логин/пароль корректны

$postsData = json_decode(file_get_contents('https://jsonplaceholder.typicode.com/posts'), true);
$commentsData = json_decode(file_get_contents('https://jsonplaceholder.typicode.com/comments'), true);

$insertPost = $pdo->prepare("REPLACE INTO posts (id, user_id, title, body) VALUES (?, ?, ?, ?)");
$insertComment = $pdo->prepare("REPLACE INTO comments (id, post_id, name, email, body) VALUES (?, ?, ?, ?, ?)");

$postCount = 0;
foreach ($postsData as $post) {
    $insertPost->execute([$post['id'], $post['userId'], $post['title'], $post['body']]);
    $postCount++;
}

$commentCount = 0;
foreach ($commentsData as $comment) {
    $insertComment->execute([$comment['id'], $comment['postId'], $comment['name'], $comment['email'], $comment['body']]);
    $commentCount++;
}

echo "Загружено $postCount записей и $commentCount комментариев\n";
?>
