<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';  
    protected $fillable = ['title', 'body', 'created_at'];  
    public $timestamps = false;  


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
