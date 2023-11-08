@php use App\Facades\ImageFacade; @endphp
<div>
    <figure class="avatar {{ $class ?? '' }}">
        <img class="avatar img-fit-cover"
             src="{{ Image::smallAvatarSize()->get('/storage/avatars/' . $user->avatar) }}"
             alt="{{ $user->name }} avatar">
    </figure>
    <a href="{{ route('users.show', $user->username) }}">{{ $user->username }}</a>
</div>
