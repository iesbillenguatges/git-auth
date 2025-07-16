<?php
session_start();

$client_id = 'Ov23liwh4Ztu2IXMcofS';
$client_secret = '3bd1c3823ce36f8ff2e418a4b24b60e76e111fdc';
$redirect_uri = 'https://git-auth-cpf4.onrender.com/auth.php';

if (!isset($_GET['code'])) {
    $auth_url = "https://github.com/login/oauth/authorize?client_id=$client_id&redirect_uri=$redirect_uri&scope=user";
    header('Location: ' . $auth_url);
    exit;
} else {
    $code = $_GET['code'];

    $token_url = "https://github.com/login/oauth/access_token";
    $data = [
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'code' => $code,
        'redirect_uri' => $redirect_uri
    ];

    $options = ['http' => [
        'method'  => 'POST',
        'header'  => "Content-type: application/x-www-form-urlencoded\r\nAccept: application/json",
        'content' => http_build_query($data)
    ]];

    $context  = stream_context_create($options);
    $response = file_get_contents($token_url, false, $context);
    $token_data = json_decode($response, true);

    if (isset($token_data['access_token'])) {
        $access_token = $token_data['access_token'];

        $opts = ['http' => [
            'method' => 'GET',
            'header' => "Authorization: token $access_token\r\nUser-Agent: miniapp"
        ]];
        $context = stream_context_create($opts);
        $user_info = file_get_contents('https://api.github.com/user', false, $context);
        $user = json_decode($user_info, true);

        $_SESSION['username'] = $user['login'] ?? 'Desconegut';
        header('Location: index.php');
        exit;
    } else {
        echo "Error d'autenticació amb GitHub";
    }
}
