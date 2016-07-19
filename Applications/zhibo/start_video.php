<?php
/**
 * Created by PhpStorm.
 * User: Ciro
 * Date: 16/7/19
 * Time: 下午4:13
 */

use \Workerman\Worker;
use \Workerman\WebServer;
use \Workerman\Protocols\Websocket;

require_once __DIR__ . '/../../Workerman/Autoloader.php';

//录制协议工作流
$recv_worker = new Worker('Websocket://0.0.0.0:18880');
$recv_worker->name = "recVideo";
$recv_worker->onWorkerStart = function($recv_worker){
    $send_worker = new Worker('Websocket://0.0.0.0:18881');
    $send_worker->onMessage = function($connection, $data){

    };
    $recv_worker->sendWorker = $send_worker;
    $send_worker->listen();
};


$recv_worker->onMessage = function($connection, $data) use ($recv_worker){
    foreach($recv_worker->sendWorker->connections as $send_connection){
        $send_connection->send($data);
    }
};

if(!defined('GLOBAL_START'))
{
    Worker::runAll();
}
