<?php
// Đo thời gian chạy web ~ thời gian bắt đầu
$timeExecute = -microtime(true);

// Lấy giao thức đang thực thi
$protocol = (!empty($_SERVER["HTTPS"]) // Kiểm tra https có tồn tại
		&& $_SERVER["HTTPS"] != "off" // Kiểm tra https đã bị tắt
		|| $_SERVER["SERVER_PORT"] == 443) // Kiểm tra post tương ứng với giao thức https
	? "https://" : "http://";

// Định nghĩa tên domain
defined("DOMAIN_NAME")
	|| define("DOMAIN_NAME", $protocol . $_SERVER["HTTP_HOST"]);

// Đường dẫn vào thư mục application
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Định nghĩa môi trường
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Đường dẫn đến thư viện ~ nên khai đặt thư viện trong thư mục library
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'), // Nên để một cái này
    realpath(APPLICATION_PATH . '/../../library'),
    realpath(APPLICATION_PATH . '/../../../library'),
    get_include_path(),
)));

// Khởi động Zend
require_once 'Zend/Application.php';

// Khởi động file application.ini
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

// Khởi động module - controller - action
$application->bootstrap()
            ->run();

// Đo thời gian chạy web ~ thời gian kết thúc
$timeExecute += microtime(true);
//echo "<span style='display:none;'>Time Execute: " . $timeExecute . "</span>";