<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Model.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../app/models/User.php';
require_once __DIR__ . '/../app/controllers/HomeController.php';

use Application\Core\Database;
use Application\Core\Router;
use App\Controllers\HomeController;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

$config = require __DIR__ . '/../config/config.php';
Database::getInstance($config['db']);

$router = new Router();
$controller = new HomeController();

// تعریف مسیرها
$router->add('POST', '/register', [$controller, 'register']);
// می‌تونی اینجا مسیرهای دیگه مثل login, logout رو اضافه کنی

// گرفتن مسیر و متد درخواست
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// اجرای روت
$router->dispatch($method, $uri);

$router->add('POST', '/register', [$controller, 'register']);
$router->add('POST', '/login', [$controller, 'login']);
$router->add('GET', '/profile', [$controller, 'profile']);
