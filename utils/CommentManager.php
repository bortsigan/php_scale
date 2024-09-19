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
	 * List all comments.
	 *
	 * @return \Illuminate\Support\Collection A collection of comments with selected fields and their associated news.
	 */
	public function listComments()
	{
		return Comment::with('news')->get()->map(function ($comment) {
			return $comment->only(['id', 'body', 'created_at', 'news_id']);
		});
	}

	/**
	 * List comments for a specific news.
	 *
	 * @param int $newsId The ID of the news for which to list comments.
	 * @return \Illuminate\Database\Eloquent\Collection A collection of comments for the specified news.
	 */
	public function listCommentsForNews($newsId)
	{
		return Comment::where('news_id', $newsId)->get();
	}

	/**
	 * Add a comment for a specific news.
	 *
	 * @param string $body The content of the comment.
	 * @param int $newsId The ID of the news to which the comment belongs.
	 * @return int The ID of the newly created comment.
	 * @throws \Exception If an error occurs during the creation or validation of the comment.
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
		} catch (\Exception $e) {
			$this->db->rollback();
			throw new \Exception($e->getMessage());
		}
	}

	/**
	 * Delete a comment.
	 *
	 * @param int $id The ID of the comment to be deleted.
	 * @return int The number of records deleted.
	 * @throws \Exception If an error occurs during the deletion of the comment.
	 */
	public function deleteComment($id)
	{
		try {
			$this->db->beginTransaction();

			$delete = Comment::destroy($id);

			$this->db->commit();

			return $delete;
		} catch (\Exception $e) {
			$this->db->rollback();
			throw new \Exception($e->getMessage());
		}
	}
}
