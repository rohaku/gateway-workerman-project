<?php
/**
 * Created by PhpStorm.
 * User: Ciro
 * Date: 16/7/19
 * Time: 下午4:05
 */

use \Workerman\Worker;
use \Workerman\WebServer;
use \Workerman\Protocols\Websocket;

require_once __DIR__ . '/../../Workerman/Autoloader.php';

//webServer
$web_server = new WebServer('http://0.0.0.0:18888');

$web_server->count = 1;
//设置web站点根目录
$web_server->addRoot('zhibo.ciro.fedeen.com', __DIR__.'/SiteRoot');

if(!defined(GLOBAL_START)){
    Worker::runAll();
}