<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['email'])) {
    // Process the checkout and place the order
}

