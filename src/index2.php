<?php
// Redis 연결 함수
function redisConnect() {
    try {
        $redis = new Redis();
        // Redis에 연결
        $redis->connect('test-redis2.5ewvz6.ng.0001.use1.cache.amazonaws.com', 6379);
        echo "Connected to Redis<br>";

        // Redis 서버에 PING 명령어 전송
        $pong = $redis->ping();
        echo "PING response: " . $pong . "<br>";
        
        return $redis;
    } catch (Exception $e) {
        die('Redis connection failed: ' . $e->getMessage());
    }
}

// Redis 연결
$redis = redisConnect();
?>
