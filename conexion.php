	<?php
	/**
	 * Autor: EAMM
	 * Fecha inicio: 01/02/2021
	 * Descripción: Clase de conexión a la base de datos
	 * Fecha Modificación: 17/03/2021
	 */
	require_once 'config.php';
	class Conexion extends PDO
	{

		private $driver = CONFIG['db']['driver'];
		private $host = CONFIG['db']['host'];
		private $port = CONFIG['db']['port'];
		private $user = CONFIG['db']['user'];
		private $pass = CONFIG['db']['pass'];
		private $dbName = CONFIG['db']['dbName'];
		private $charset = CONFIG['db']['charset'];
		private static $_db;

		function __construct()
		{
			date_default_timezone_set("America/Mexico_City"); // Establece la zona horaria predeterminada usada por todas las funciones de fecha/hora en un script
		}

		protected function conexionMySQL()
		{
			if (!self::$_db) {
				try {
					$opciones = [
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
						PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
						PDO::ATTR_EMULATE_PREPARES => false,
						PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
					];
					$mbd = new PDO("{$this->driver}:host={$this->host};port={$this->port};dbname={$this->dbName};charset={$this->charset}", $this->user, $this->pass, $opciones);
					self::$_db = $mbd;
				} catch (PDOException $e) {
					print "¡Error!: " . $e->getMessage() . "<br/>";
					die();
				}
			}
			return self::$_db;
		}

		public function getFecha()
		{
			return date("Y-m-d"); //(el formato DATETIME de MySQL)
		}

		public function getFechaRegistrado()
		{ //fecha registro
			return date("Y-m-d H:i:s"); //(el formato DATETIME de MySQL)
		}

		public function json($arraydata)
		{
			echo json_encode($arraydata);
		}
	}
	?>