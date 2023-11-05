<?php

namespace App\Models;

use App\Services\MarkdownFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes, HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($post) {
            $post->content = MarkdownFormat::replace_first_level_headers_to_second_level($post->content);
        });
    }

    public function relatedPosts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_post', 'post1_id', 'post2_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = ['title', 'content', 'user_id'];
    protected $dates    = ['deleted_at'];

    public static function rules()
    {
        return [
            'title'   => 'required|min:3|max:255',
            'content' => 'required|min:10',
        ];
    }
}
