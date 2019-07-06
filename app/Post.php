<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Scopes\TitleScope;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    protected $perPage = 10;

    protected $dates = ['created_at', 'deleted_at']; // which fields will be Carbon-ized

    protected $fillable = [
        'title', 'content', 'status', 'category_id', 'user_id'
    ];

    public $timestamps = true;
   
    // global scopes
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new TitleScope);
    }

    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
  
    /**
     * Scope a query to only include posts of a given type.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  mixed $type
     * @return \Illuminate\Database\Eloquent\Builder
     */

    static function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
    
}
