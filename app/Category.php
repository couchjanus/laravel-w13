<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $perPage = 10;

    protected $fillable = [
        'name', 'description', 'active'
    ];

    protected $dates = ['created_at', 'deleted_at']; // which fields will be Carbon-ized

    public function posts()
    {
        // Получить статьи блога.
        return $this->hasMany(Post::class);
    }

}
