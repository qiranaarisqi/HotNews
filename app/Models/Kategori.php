<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'created_at',
        'updated_at',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'id_kategori', 'id_kategori');
    }
}
