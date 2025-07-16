<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo '<a href="auth.php">Inicia sessió amb GitHub</a>';
    exit;
}

echo "<h1>Estàs dins!</h1>";
echo "<p>Usuari: " . htmlspecialchars($_SESSION['username']) . "</p>";
echo '<a href="logout.php">Logout</a>';
