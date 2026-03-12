<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coment extends Model
{
    use HasFactory;

    protected $table = 'coment';
    protected $primaryKey = 'id_coment';
    public $timestamps = false;

    // Use created_at as only timestamp
    const CREATED_AT = 'created_at';
    protected $fillable = [
        'article_id',
        'user',
        'content',
        'status',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id', 'id_article');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user', 'id_user');
    }
}
