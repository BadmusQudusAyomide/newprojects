<?php
include 'db.php';

$sql = "SELECT posts.id, posts.content, users.username, 
        (SELECT COUNT(*) FROM likes WHERE likes.post_id = posts.id) AS likes,
        (SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id) AS comments
        FROM posts
        JOIN users ON posts.user_id = users.id
        ORDER BY posts.created_at DESC";
$result = $conn->query($sql);

$posts = [];
while($row = $result->fetch_assoc()) {
    $post_id = $row['id'];
    
    // Fetch comments
    $comments_sql = "SELECT comments.comment, users.username 
                     FROM comments 
                     JOIN users ON comments.user_id = users.id 
                     WHERE comments.post_id = $post_id";
    $comments_result = $conn->query($comments_sql);
    $comments = [];
    while($comment = $comments_result->fetch_assoc()) {
        $comments[] = $comment;
    }

    $row['comments'] = $comments;
    $posts[] = $row;
}

echo json_encode($posts);

$conn->close();
?>