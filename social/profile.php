<?php
include 'templates/header.php';
include 'php/user.php';

$userId = $_GET['id'];
$user = getUserProfile($userId);
?>

<div class="profile">
    <div class="cover-photo" style="background-image: url('uploads/cover_photos/<?php echo $user['cover_photo']; ?>');"></div>
    <div class="profile-picture">
        <img src="uploads/profile_pictures/<?php echo $user['profile_picture']; ?>" alt="Profile Picture">
    </div>
    <div class="bio">
        <p><?php echo $user['bio']; ?></p>
    </div>
</div>

<?php include 'templates/footer.php'; ?>
