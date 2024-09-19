<?php

namespace App\Utils;

use Illuminate\Database\Capsule\Manager as Capsule;

class DB
{
	private static $instance = null;
	private Capsule $capsule;

	public function __construct()
	{
		// Initialize the database connection
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
			#'unix_socket' => '/Applications/MAMP/tmp/mysql/mysql.sock'
		]);

		$this->capsule->setAsGlobal();
		$this->capsule->bootEloquent();
	}

	/**
	 * Get the singleton instance of the DB class.
	 *
	 * @return DB The single instance of the DB class.
	 * @throws \Exception If an error occurs during instantiation.
	 */
	public static function getInstance()
	{
		try {
			if (self::$instance === null) {
				self::$instance = new self();
			}
			return self::$instance;
		} catch (\Exception $e) {
			throw new $e;
		}
	}

	/**
	 * Get the database manager instance.
	 *
	 * @return \Illuminate\Database\DatabaseManager The database manager instance.
	 */
	public function getDBManager()
	{
		return $this->capsule->getDatabaseManager();
	}

	/**
	 * Select all records from a specified table.
	 *
	 * @param string $table The name of the table.
	 * @return \Illuminate\Support\Collection The collection of records from the specified table.
	 */
	public function select($table)
	{
		return Capsule::table($table)->get();
	}

	/**
	 * Execute a raw SQL statement.
	 *
	 * @param string $sql The SQL statement to execute.
	 * @return bool True on success, false on failure.
	 */
	public function exec($sql)
	{
		return Capsule::statement($sql);
	}

	/**
	 * Get the ID of the last inserted record.
	 *
	 * @return string The ID of the last inserted record.
	 */
	public function lastInsertId()
	{
		return Capsule::getConnection()->getPdo()->lastInsertId();
	}

	/**
	 * Begin a new database transaction.
	 *
	 * @return void
	 */
	public function beginTransaction()
	{
		Capsule::connection()->beginTransaction();
	}

	/**
	 * Commit the current database transaction.
	 *
	 * @return void
	 */
	public function commit()
	{
		Capsule::connection()->commit();
	}

	/**
	 * Roll back the current database transaction.
	 *
	 * @return void
	 */
	public function rollback()
	{
		Capsule::connection()->rollBack();
	}
}
