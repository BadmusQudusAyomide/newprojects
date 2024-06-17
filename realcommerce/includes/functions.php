 <?php
function redirectIfNotAdmin() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
        header('Location: ../login.php');
        exit();
    }
}
?> 