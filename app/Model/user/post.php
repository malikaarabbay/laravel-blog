<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Elasticquent\ElasticquentTrait;
class post extends Model
{
    use ElasticquentTrait;
    protected $fillable = ['title', 'description'];

    protected $attributes = [
        'is_published' => 0,
    ];

    public function tags(){
        return $this->belongsToMany('App\Model\user\tag', 'post_tags')->withTimestamps();
    }

    public function categories(){
        return $this->belongsToMany('App\Model\user\category', 'category_posts')->withTimestamps();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value, '-');
    }
}
