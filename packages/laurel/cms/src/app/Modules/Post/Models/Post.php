<?php


namespace Laurel\CMS\Modules\Post\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Laurel\CMS\Modules\Auth\Models\User;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'seo_title', 'seo_description', 'seo_keywords',
        'seo_robots_txt', 'text', 'attributes', 'views'
    ];

    protected $casts = [
        'attributes' => 'array'
    ];

    protected static function booted()
    {
        static::creating(function (self $post) {
            $post->createdBy()->associate(Auth::user());
            $post->updatedBy()->associate(Auth::user());
        });

        static::updating(function (self $post) {
            $post->updatedBy()->associate(Auth::user());
        });
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function increaseView()
    {
        $this->views++;
        $this->saveOrFail();

        return $this;
    }
}
