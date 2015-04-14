<?php 
class DataConnect {
	private static $db_host = 'localhost';
	private static $db_name = 'election';
	private static $db_user = 'panicUser';
	private static $db_pass = '123';
	private static $connect = null;

	public function __construct() {
		die('No constructor');
	}

	public static function connect() {
		if (null == self::$connect) {
			try {
				self::$connect = new PDO('mysql:host='.self::$db_host.';dbname='.self::$db_name, self::$db_user, self::$db_pass);
				self::$connect->setAttribute(PDO::ATTR_ERRRMODE, PDO::ERRMODE_WARNING);
			} catch(PDOException $e) {
				$e->getCode();
			}
		}
		return self::$connect;
	}

	public static function disconnect() {
		self::$connect = null;
	}
}
 ?>