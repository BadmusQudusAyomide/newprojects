<?php
include 'templates/header.php';
include 'php/post.php';

$userId = $_SESSION['user_id'];
$posts = getPosts($userId, 'public');
?>

<div class="posts">
    <?php foreach ($posts as $post): ?>
        <div class="post">
            <p><?php echo $post['content']; ?></p>
            <?php if ($post['media']): ?>
                <img src="uploads/post_media/<?php echo $post['media']; ?>" alt="Post Media">
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>

<?php include 'templates/footer.php'; ?>