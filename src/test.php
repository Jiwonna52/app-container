<?php
session_start();

// Redis 연결 함수
function redisConnect() {
    try {
        $redis = new Redis();
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ]);
        $redis->connect('test-redis2.5ewvz6.ng.0001.use1.cache.amazonaws.com', 6379, 10, NULL, 0, 0, ['stream_context' => $context]);
        return $redis;
    } catch (Exception $e) {
        die('Redis connection failed: ' . $e->getMessage());
    }
}

// 세션 저장 핸들러 설정
$redis = redisConnect();
session_set_save_handler(
    function($path, $name) use ($redis) { return true; }, // open
    function() use ($redis) { return true; }, // close
    function($id) use ($redis) { return $redis->get('PHPREDIS_SESSION:' . $id); }, // read
    function($id, $data) use ($redis) { return $redis->set('PHPREDIS_SESSION:' . $id, $data); }, // write
    function($id) use ($redis) { return $redis->del('PHPREDIS_SESSION:' . $id); }, // destroy
    function($max_lifetime) use ($redis) { return true; } // gc
);
session_start();

// 세션 테스트
$_SESSION['test'] = 'This is a test session variable';

echo 'Session data saved to Redis: ' . $_SESSION['test'];
?>
