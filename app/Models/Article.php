<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'article';
    protected $primaryKey = 'id_article';
    public $timestamps = true;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'status',
        'views',
        'created_at',
        'updated_at',
        'id_user',
        'id_kategori',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function category()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags', 'article_id', 'tags_id');
    }

    public function comments()
    {
        return $this->hasMany(Coment::class, 'article_id', 'id_article');
    }
}
