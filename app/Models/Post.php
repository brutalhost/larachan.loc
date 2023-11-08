<?php

namespace App\Models;

use App\Services\Helpers\MarkdownFormat;
use App\Services\Interfaces\SiblingsInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model implements SiblingsInterface
{
    use SoftDeletes, HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($post) {
            $post->content = MarkdownFormat::replaceFirstLevelHeaders($post->content);
        });
    }

    public function relatedPosts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_post', 'post1_id', 'post2_id');
    }

    public function shortTitle($limit = 30) {
        return \Str::limit($this->title, $limit);
    }

    public function shortContent($limit = 30) {
        return \Str::limit($this->content, $limit);
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

    // Siblings
    public function previous()
    {
        $previous = self::where('id', '<', $this->id)->orderBy('id', 'desc')->first();
        return $previous ?? self::orderBy('id', 'desc')->first();
    }

    public function next()
    {
        $next = self::firstWhere('id', '>', $this->id);
        return $next ?? self::first();
    }

    public function getShowUrl()
    {
        return route('posts.show', $this);
    }
}
