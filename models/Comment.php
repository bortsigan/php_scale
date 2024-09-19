<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';  

    protected $fillable = ['body', 'created_at', 'news_id'];  

    public $timestamps = false; 


    public function news()
    {
        return $this->belongsTo(News::class);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getNewsId()
    {
        return $this->newsId;
    }
}
