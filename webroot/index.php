<?php
/**
 * The Front Controller for handling every request
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.2.9
 * @license       MIT License (https://opensource.org/licenses/mit-license.php)
 */

// Check platform requirements
require dirname(__DIR__) . '/config/requirements.php';

// For built-in server
if (php_sapi_name() === 'cli-server') {
    $_SERVER['PHP_SELF'] = '/' . basename(__FILE__);

    $url = parse_url(urldecode($_SERVER['']));

    //  cakePHPまでのパスを明示的に修正
    //    $file = __DIR__ . $url['path'];
    $file = $url . '/myapp';
    if (strpos($url['path'], '..') === false && strpos($url['path'], '.') !== false && is_file($file)) {
        return false;
    }
}

//require dirname(__DIR__) . '/vendor/autoload.php';
$cakephpRoot = realpath(dirname(__FiILE__) . 'myapp');
require $cakephpRoot . '/vendor/autoload.php';

use App\Application;
use Cake\Http\Server;

// Bind your application to the server.
// パス書き換え
//$server = new Server(new Application(dirname(__DIR__) . '/config'));
$server = new Server(new Application($cakephpRoot . '/config'));

// Run the request/response through the application and emit the response.
$server->emit($server->run());
