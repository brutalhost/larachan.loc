<?php

namespace App\Http\Controllers;

use App\Facades\NotificationFacade;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->authorizeResource(User::class, 'user');
    }

    public function index(SearchRequest $request)
    {
        $request->urlSearchKey = 'userSearch';
        $urlSearchString                = $request->getSearchString();

        $users = User::query();
        if (!empty($urlSearchString)) {
            $users = $users
                ->where('name', 'like', "%{$urlSearchString}%")
                ->orWhere('username', 'like', "%{$urlSearchString}%")
                ->orWhere('email', 'like', "%{$urlSearchString}%");
        }

        $users = $users
//            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends([$request->urlSearchKey => $urlSearchString]);

        return view('users.index')
            ->with([
                'users'     => $users,
                'searchKey' => $request->urlSearchKey
            ]);
    }

    public function show(User $user)
    {
        $previous = $user->previous();
        $next = $user->next();
        $posts = $user->posts()->get();
        return view('users.show', [
            'user' => $user,
            'posts' => $posts,
            'previous' => $previous,
            'next' => $next,
        ]);
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
        ]);
    }

    public function update(UserRequest $request, User $user)
    {
        $nullRequestKeys = array_keys($request->all(), null);
        $filledData = $request->except($nullRequestKeys, 'avatar');
        $user->update($filledData);
        if ($request->hasFile('avatar')) {
            $avatarName = time().'.'.$request->avatar->getClientOriginalExtension();
            $request->avatar->move(public_path('avatars'), $avatarName);
            $user->avatar = $avatarName;
        }
        $user->save();

        NotificationFacade::toast('Profile updated successfully');
        return redirect()->route('users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        if (auth()->user()->username == $user->username) {
            session()->invalidate();
            session()->regenerateToken();
        }

        $user->delete();

        NotificationFacade::toast('Profile deleted successfully');
        return redirect()->route('users.index');
    }
}
