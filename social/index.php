

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Networking Platform</title>
    <link rel="stylesheet" href="styles.css">
    <script src="like.js" defer></script>
    <script src="comment.js" defer></script>
</head>
<body>
    <div class="navbar">
        <a href="profile.php">Profile</a>
        <a href="friends.php">Friends</a>
        <a href="messages.php">Messages</a>
        <a href="notifications.php">Notifications</a>
    </div>
    <div class="content">
        <?php
        include 'post.php';
        $posts = getPosts();
        foreach ($posts as $post) {
            $comments = getComments($post['id']);
            echo "<div class='post'>";
            echo "<p>{$post['content']}</p>";
            echo "<button class='like-btn' data-post-id='{$post['id']}'>Like</button>";
            echo "<span id='likes-count-{$post['id']}'>{$post['likes']}</span>";

            echo "<div id='comments-container-{$post['id']}' class='comments'>";
            foreach ($comments as $comment) {
                echo "<div class='comment'>" . htmlspecialchars($comment['content']) . "</div>";
            }
            echo "</div>";

            echo "<form data-post-id='{$post['id']}' class='comment-form'>
                      <input type='hidden' name='_csrf_token' value='{$_SESSION['_csrf_token']}'>
                      <input type='text' class='comment-input' placeholder='Write a comment...'>
                      <button type='submit'>Submit</button>
                  </form>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>