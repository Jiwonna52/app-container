<?php
session_start();
require 'vendor/autoload.php';

use Predis\Client;

// AWS Elasticache for Redis 설정
$redis = new Client([
    'scheme' => 'tcp',
    'host'   => 'test-elastic.5ewvz6.clustercfg.use1.cache.amazonaws.com:6379', // 변경해야 합니다
    'port'   => 6379,
]);

$session_id = session_id();
$user_id = $redis->get($session_id);

if (!$user_id) {
    header('Location: index.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
</head>
<body>
    <h1>환영합니다, <?php echo htmlspecialchars($user_id); ?>님!</h1>
    <p>이 페이지는 로그인한 사용자만 볼 수 있습니다.</p>
</body>
</html>
