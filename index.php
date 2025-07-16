<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo '<!DOCTYPE html>
    <html lang="ca">
    <head>
        <meta charset="UTF-8">
        <title>Inicia sessió</title>
        <style>
            body {
                font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
                background: linear-gradient(135deg, #4b6cb7, #182848);
                color: #fff;
                text-align: center;
                padding-top: 100px;
            }
            a {
                display: inline-block;
                padding: 12px 24px;
                background-color: #00b894;
                color: white;
                text-decoration: none;
                border-radius: 6px;
                font-size: 18px;
                transition: background 0.3s ease;
            }
            a:hover {
                background-color: #019875;
            }
        </style>
    </head>
    <body>
        <h1>Benvingut</h1>
        <a href="auth.php">Inicia sessió amb GitHub</a>
    </body>
    </html>';
    exit;
}

$username = htmlspecialchars($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Benvingut</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1f4037, #99f2c8);
            color: #2c3e50;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            animation: fadeIn 1s ease-in;
        }

        h1 {
            font-size: 3em;
            margin-bottom: 10px;
        }

        p {
            font-size: 1.5em;
            margin-bottom: 30px;
        }

        a {
            padding: 12px 30px;
            background-color: #e74c3c;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            transition: background 0.3s ease;
        }

        a:hover {
            background-color: #c0392b;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <h1>Estàs dins!</h1>
    <p>Usuari: <strong><?= $username ?></strong></p>
    <a href="logout.php">Logout</a>
</body>
</html>
