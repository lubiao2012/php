<?php
/**
 * Created by wangrun03(wagnrun03@baidu.com).
 * Date: 16/5/30
 * Time: 下午7:22
 */

echo "<h2>tcp/ip connect</h2>";
$service_port = 18888;
$address = '127.0.0.1';

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if($socket === false){
    echo 'socket_create() failed:reason:'.socket_strerror($socket_last_error())."\n";
}else{
    echo 'ok.\n';
}

echo "Attempting to connect to '$address' on port '$service_port'...";
$result = socket_connect($socket, $address, $service_port);
if($result === false){
    echo "socket_connect() failed.\nReason:($result)".socket_strerror(socket_last_error($socket))."\n";
}else{
    echo 'ok.\n';
}

$in = "HEAD / http/1.1\r\n";
$in .= "HOST:localhost \r\n";
$in .= "Connection : close\r\n\r\n";
$out = "";
echo "sending http head request...";
socket_write($socket, $in, strlen($in));
echo "send ok.\n";

echo "reading response:\n\n";
while($out = socket_read($socket, 8192)){
    echo $out;
}

echo "closeing socket...";
socket_close($socket);
echo 'ok.\n\n';













<?php
/**
 * Created by wangrun03(wagnrun03@baidu.com).
 * Date: 16/5/30
 * Time: 下午6:52
 */

error_reporting(E_ALL);
set_time_limit(0);


$address = '127.0.0.1';
$port=18888;
//创建socket
if(($sock=socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false){
    echo "socket_create() failed:reason:".socket_strerror(socket_last_error())."\n";
}

//绑定
if(socket_bind($sock, $address, $port) === false){
    echo "socket_bind() failed:reason:".socket_strerror(socket_last_error($sock))."\n";
}

//监听
if(socket_listen($sock, 5) === false){
    echo "socket_bind() failed:reason:".socket_strerror(socket_last_error($sock))."\n";
}

do{
    if(($msgsock = socket_accept($sock)) === false){
        echo "socket_accepty() failed : reason:".socket_strerror(socket_last_error($sock))."\n";
        break;
    }

    echo "read client message\n";
    $buf = socket_read($msgsock, 8192);
    $talkback = "received message:$buf\n";
    echo $talkback;

    $msg = "<font color='red'>server send:welcome</font><br />";
    socket_write($msgsock, $msg, strlen($msg));
    if(false === socket_write($msgsock, $talkback, strlen($talkback))){
        echo "socket_write() failed reason:".socket_strerror(socket_last_error($sock));
    }else{
        echo 'send success';
    }
    socket_close($msgsock);
}while(true);
socket_close($sock);


