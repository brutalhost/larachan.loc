<form action="{{ $route ?? request()->url() }}" class="{{ $class ?? '' }}">
    <div class="input-group input-inline">
        @csrf
        <input class="form-input" name="{{ $searchKey }}" id="search" type="text" placeholder="search"
               @if(request()->filled($searchKey)) value="{{ request()->input($searchKey) }}" @endif>
        <button class="btn btn-primary input-group-btn">Search</button>
    </div>
</form>
