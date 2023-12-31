@php
    $btnIcon = '/assets/ForumX/images/icon-like.png';
    $btnIconActive = '/assets/ForumX/images/icon-like-active.png';
@endphp

@if ($icon)
    @php
        $btnIcon = $icon['imageUrl'];
        $btnIconActive = $icon['imageActiveUrl'];
    @endphp
@endif

<form action="{{ route('fresns.api.user.mark') }}" method="post">
    @csrf
    <input type="hidden" name="interactionType" value="like"/>
    <input type="hidden" name="markType" value="post"/>
    <input type="hidden" name="fsid" value="{{ $pid }}"/>
    @if ($interaction['likeStatus'])
        <a class="btn btn-inter btn-active fs-mark" data-interaction-active="{{ $interaction['likeStatus'] }}" data-icon-active="{{ $btnIconActive }}" data-icon="{{ $btnIcon }}">
            <img src="{{ $btnIconActive }}" loading="lazy">
            @if (fs_api_config('post_liker_count') && $count)
                <span class="show-count">{{ $count }}</span>
            @endif
        </a>
    @else
        <a class="btn btn-inter fs-mark" data-icon-active="{{ $btnIconActive }}" data-icon="{{ $btnIcon }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $interaction['likeName'] }}">
            <img src="{{ $btnIcon }}" loading="lazy">
            @if (fs_api_config('post_liker_count') && $count)
                <span class="show-count">{{ $count }}</span>
            @endif
        </a>
    @endif
</form>
