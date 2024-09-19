<?php

namespace App\Utils;

use App\Models\News;
use App\Validations\NewsValidation;
use App\Utils\DB;
use Illuminate\Validation\Factory;

class NewsManager
{
	private DB $db;
	private Factory $validator;

	public function __construct()
	{
		$this->db = DB::getInstance();
	}

	/**
	 * List all news using the Eloquent model
	 */
	public function listNews()
	{
		return News::with('comments')->get();
	}

	/**
	 * Add a news record using the Eloquent model
	 */
	public function addNews($title, $body)
	{
		try {
			$this->db->beginTransaction();

			$validator = new NewsValidation;

			$data = [
				'title' => $title,
				'body' => $body,
				'created_at' => date("Y-m-d H:i:s")
			];

			$validator->validate($data);

			$news = News::create($data);

			$this->db->commit();

			return $news->id;
		} catch (\Exception $e) {
			$this->db->rollback();
			throw new \Exception($e->getMessage());
		}
	}

	/**
	 * Delete a news record
	 */
	public function deleteNews($id)
	{
		try {
			$this->db->beginTransaction();

			$deleteNews = News::destroy($id);

			$this->db->commit();

			return $deleteNews;

		} catch (\Exception $e) {
			$this->db->rollback();
			throw new \Exception($e->getMessage());
		}
	}
}
