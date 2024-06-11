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

// 로그인 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    
    // 예시: 유저 아이디를 세션에 저장
    $_SESSION['user_id'] = $id;
    
    // Redis에 세션 데이터 저장
    $session_id = session_id();
    $redis->set($session_id, $id);
    
    header('Location: welcome.php');
    exit();
}
?>
