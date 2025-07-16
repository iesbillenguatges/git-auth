<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: auth.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Benvingut</title>
</head>
<body>
    <h1>Estàs dins com a <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
    <form action="logout.php" method="post">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
