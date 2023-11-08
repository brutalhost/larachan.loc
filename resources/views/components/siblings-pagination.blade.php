<ul class="pagination">
    @unless(empty($previous))
        <li class="page-item page-prev">
            <a href="{{ $previous->getShowUrl() }}">
                <div class="page-item-subtitle">Previous</div>
                <div class="page-item-title h5">{{ $previous->title }}</div>
            </a>
        </li>
    @else
        <li class="page-item page-prev">
            <div class="page-item-subtitle">Previous</div>
            <div class="page-item-title h5">It is first page</div>
        </li>
    @endunless

    @unless(empty($next))
        <li class="page-item page-next">
            <a href="{{ $next->getShowUrl() }}">
                <div class="page-item-subtitle">Next</div>
                <div class="page-item-title h5">{{ $next->title }}</div>
            </a>
        </li>
    @else
        <li class="page-item page-next">
            <div class="page-item-subtitle">Previous</div>
            <div class="page-item-title h5">It is last page</div>
        </li>
    @endunless
</ul>
