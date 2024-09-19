<?php

namespace App\Utils;

use App\Models\Comment;
use App\Validations\CommentValidation;
use App\Utils\DB;
use Illuminate\Validation\Factory;

class CommentManager
{
	private DB $db;
	private Factory $validator;

	public function __construct()
	{
		$this->db = DB::getInstance();
	}
	/**
	 * List all comments
	 */
	public function listComments()
	{
		return Comment::with('news')->get()->map(function ($comment) {
			return $comment->only(['id', 'body', 'created_at', 'news_id']);
		});
	}

	/**
	 * List comments for a specific news
	 */
	public function listCommentsForNews($newsId)
	{
		// Using Eloquent to fetch comments linked to a specific news
		return Comment::where('news_id', $newsId)->get();
	}

	/**
	 * Add a comment for a specific news
	 */
	public function addCommentForNews($body, $newsId)
	{

		try {
			$this->db->beginTransaction();

			$validator = new CommentValidation;

			$data = [
				'body' => $body,
				'created_at' => date("Y-m-d H:i:s"),
				'news_id' => $newsId
			];

			$validator->validate($data);

			$comment = Comment::create($data);

			$this->db->commit();

			return $comment->id;
		} catch (Exception $e) {
			$this->db->rollback();
			throw new \Exception($e->getMessage());
		}
	}

	/**
	 * Deletes a comment
	 */
	public function deleteComment($id)
	{
		try {
			$this->db->beginTransaction();

			$delete = Comment::destroy($id);

			$this->db->commit();

			return $delete;
		} catch(\Exception $e) {
			$this->db->rollback();
			throw new \Exception($e->getMessage());
		}
	}
}