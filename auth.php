<?php
session_start();

$client_id = getenv('GITHUB_CLIENT_ID');
$client_secret = getenv('GITHUB_CLIENT_SECRET');
$redirect_uri = getenv('GITHUB_REDIRECT_URI');

if (!isset($_GET['code'])) {
    $auth_url = "https://github.com/login/oauth/authorize?client_id=$client_id&redirect_uri=$redirect_uri&scope=user";
    header("Location: $auth_url");
    exit;
} else {
    $code = $_GET['code'];

    $token_response = file_get_contents("https://github.com/login/oauth/access_token?" . http_build_query([
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'code' => $code,
        'redirect_uri' => $redirect_uri
    ]), false, stream_context_create([
        'http' => [
            'header' => "Accept: application/json"
        ]
    ]));

    $token = json_decode($token_response, true)['access_token'];

    $user_response = file_get_contents("https://api.github.com/user", false, stream_context_create([
        'http' => [
            'header' => "Authorization: token $token\r\nUser-Agent: PHP"
        ]
    ]));
    $user = json_decode($user_response, true);

    $_SESSION['username'] = $user['login'];
    header('Location: index.php');
    exit;
}
