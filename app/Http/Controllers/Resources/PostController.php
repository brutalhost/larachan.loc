<?php

namespace App\Http\Controllers\Resources;

use App;
use App\Facades\DataTable;
use App\Facades\Notification;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Authenticate;
use App\Http\Requests\PostRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->authorizeResource(Post::class, 'post');
    }

    public function index(SearchRequest $request)
    {
        $request->urlSearchKey = 'postSearch';
        $urlSearchString       = $request->getSearchString();

        $posts = Post::query()->orderBy('created_at', 'desc');
        if (!empty($urlSearchString)) {
            $posts = $posts->where('title', 'like', "%{$urlSearchString}%");
        }

        $posts = $posts
            ->paginate(6)
            ->appends([$request->urlSearchKey => $urlSearchString]);

        return view('posts.index')->with([
            'posts'     => $posts,
            'searchKey' => $request->urlSearchKey
        ]);
    }

    public function create()
    {
        return view('posts.create-or-edit');
    }

    public function store(PostRequest $request)
    {
        $post          = new Post($request->validated());
        $post->user_id = Auth::id();
        $post->save();

        Notification::toast('Post created successfully.');
        return redirect()->route('posts.show', $post);
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.create-or-edit', [
            'post' => $post,
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $post->fill($request->validated());
        $post->save();

        Notification::toast('Post updated successfully.');
        return redirect()->route('posts.show', $post);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        Notification::toast('Post deleted successfully.');
        return redirect()->route('posts.index');
    }

}
