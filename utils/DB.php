<?php

namespace App\Utils;

use Illuminate\Database\Capsule\Manager as Capsule;


class DB
{
	private static $instance = null;
	private Capsule $capsule;

	public function __construct()
	{
		# init DB connection
		$this->capsule = new Capsule;

		$this->capsule->addConnection([
			'driver' => 'mysql',
			'host' => 'localhost',
			'port' => '8889',
			'database' => 'phptest',
			'username' => 'root',
			'password' => 'root',
			'charset' => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix' => '',
			'unix_socket' => '/Applications/MAMP/tmp/mysql/mysql.sock'
		]);

		$this->capsule->setAsGlobal();
		$this->capsule->bootEloquent();
	}

	// Singleton pattern for getting the instance
	public static function getInstance()
	{
		try {
			if (self::$instance === null) {
				self::$instance = new self();
			}
			return self::$instance;
		} catch(\Exception $e) {
			throw new $e;
		}
	}

	public function getDBManager()
	{
		// Access the capsule instance via Capsule directly
		return $this->capsule->getDatabaseManager();
	}

	public function select($table)
	{
		// Use Capsule's fluent query builder
		return Capsule::table($table)->get();
	}

	public function exec($sql)
	{
		// Using Capsule's statement method for raw SQL execution
		return Capsule::statement($sql);
	}

	public function lastInsertId()
	{
		// Get the last inserted ID
		return Capsule::getConnection()->getPdo()->lastInsertId();
	}

	public function beginTransaction()
	{
		Capsule::connection()->beginTransaction();
	}

	public function commit()
	{
		Capsule::connection()->commit();
	}

	public function rollback()
	{
		Capsule::connection()->rollBack();
	}
}
