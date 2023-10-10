<?php
define ('DB_HOST','localhost');
define ('DB_USER','esrn79_user');
define ('DB_PASS','Seis7347');
define ('DB_NAME','esrn79_db');
define ('DB_CHAR','utf8');

class Database extends PDO {
	public function __construct() {
		$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
		$options = array(
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		);

		if( version_compare(PHP_VERSION, '5.3.6', '<') ) {
			if( defined('PDO::MYSQL_ATTR_INIT_COMMAND') ) {
				$options[PDO::MYSQL_ATTR_INIT_COMMAND] = 'SET NAMES ' . DB_CHAR;
			}
		} else {
			$dsn .= ';charset=' . DB_CHAR;
		}

		parent::__construct($dsn, DB_USER, DB_PASS, $options);

		if( version_compare(PHP_VERSION, '5.3.6', '<') && !defined('PDO::MYSQL_ATTR_INIT_COMMAND') ) {
			$sql = 'SET NAMES ' . DB_CHAR;
			$this->exec($sql);
		}
	}
}

?>
