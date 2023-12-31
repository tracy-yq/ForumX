@php
    use \App\Utilities\ArrUtility;

    $iconLike = null;
    $iconDislike = null;
    $iconFollow = null;
    $iconBlock = null;
    $iconComment = null;
    $iconShare = null;
    $iconMore = null;

    $title = null;
    $decorate = null;
@endphp

@if ($comment['operations']['buttonIcons'])
    @php
        $iconLike = ArrUtility::pull($comment['operations']['buttonIcons'], 'code', 'like');
        $iconDislike = ArrUtility::pull($comment['operations']['buttonIcons'], 'code', 'dislike');
        $iconFollow = ArrUtility::pull($comment['operations']['buttonIcons'], 'code', 'follow');
        $iconBlock = ArrUtility::pull($comment['operations']['buttonIcons'], 'code', 'block');
        $iconComment = ArrUtility::pull($comment['operations']['buttonIcons'], 'code', 'comment');
        $iconShare = ArrUtility::pull($comment['operations']['buttonIcons'], 'code', 'share');
        $iconMore = ArrUtility::pull($comment['operations']['buttonIcons'], 'code', 'more');
    @endphp
@endif

@if ($comment['operations']['diversifyImages'])
    @php
        $title = ArrUtility::pull($comment['operations']['diversifyImages'], 'code', 'title');
        $decorate = ArrUtility::pull($comment['operations']['diversifyImages'], 'code', 'decorate');
    @endphp
@endif

<div class="position-relative pb-2" id="{{ $comment['cid'] }}">
    {{-- 主帖预览内容 --}}
    @component('components.comment.section.post', [
        'post' => $comment['replyToPost'],
    ])@endcomponent

    {{-- 评论作者信息 --}}
    <section class="content-author order-0">
        @component('components.comment.section.author', [
            'cid' => $comment['cid'],
            'author' => $comment['author'],
            'isAnonymous' => $comment['isAnonymous'],
            'createdDatetime' => $comment['createdDatetime'],
            'createdTimeAgo' => $comment['createdTimeAgo'],
            'editedDatetime' => $comment['editedDatetime'],
            'editedTimeAgo' => $comment['editedTimeAgo'],
            'moreJson' => $comment['moreJson'],
            'location' => $comment['location'],
            'replyToComment' => $comment['replyToComment'],
        ])@endcomponent
    </section>

    {{-- 评论内容 --}}
    <section class="content-main order-2 mx-3 position-relative">
        {{-- 标题 --}}
        <div class="content-title d-flex flex-row bd-highlight">
            {{-- 标题图标 --}}
            @if ($title)
                <img src="{{ $title['imageUrl'] }}" loading="lazy" alt="{{ $title['name'] }}" class="me-2">
            @endif

            {{-- 置顶 --}}
            @if ($comment['isSticky'])
                <img src="/assets/ForumX/images/icon-sticky.png" loading="lazy" alt="置顶" class="ms-2">
            @endif

            {{-- 精华 --}}
            @if ($comment['digestState'] == 2)
                <img src="/assets/ForumX/images/icon-digest.png" loading="lazy" alt="一级精华" class="ms-2">
            @elseif ($comment['digestState'] == 3)
                <img src="/assets/ForumX/images/icon-digest.png" loading="lazy" alt="二级精华" class="ms-2">
            @endif
        </div>

        {{-- 正文 --}}
        <div class="content-article">
            @if ($comment['isCommentPrivate'])
                <div class="alert alert-warning" role="alert">
                    <i class="bi bi-info-circle"></i> {{ fs_lang('editorCommentPrivate') }}
                </div>
            @else
                @if ($comment['isMarkdown'])
                    {!! Str::markdown($comment['content']) !!}
                @else
                    {!! nl2br($comment['content']) !!}
                @endif
            @endif
        </div>
    </section>

    {{-- 评论角标图 --}}
    @if ($decorate)
        <div class="position-absolute top-0 end-0">
            <img src="{{ $decorate['imageUrl'] }}" loading="lazy" alt="{{ $decorate['name'] }}" height="88rem">
        </div>
    @endif

    {{-- 附属文件 --}}
    <section class="content-files order-3 mx-3 mt-2 d-flex align-content-start flex-wrap file-image-{{ count($comment['files']['images']) }}">
        @component('components.comment.section.files', [
            'cid' => $comment['cid'],
            'createdDatetime' => $comment['createdDatetime'],
            'author' => $comment['author'],
            'files' => $comment['files'],
        ])@endcomponent
    </section>

    {{-- 附属扩展 --}}
    @if ($comment['extends'])
        <section class="content-extends order-3 mx-3">
            @component('components.comment.section.extends', [
                'cid' => $comment['cid'],
                'createdDatetime' => $comment['createdDatetime'],
                'author' => $comment['author'],
                'extends' => $comment['extends']
            ])@endcomponent
        </section>
    @endif

    {{-- 评论交互功能 --}}
    <section class="interaction order-5 mt-3 mx-3">
        <div class="d-flex">
            {{-- 点赞 --}}
            @if ($comment['interaction']['likeSetting'])
                <div class="interaction-box">
                    @component('components.comment.mark.like', [
                        'cid' => $comment['cid'],
                        'interaction' => $comment['interaction'],
                        'count' => $comment['likeCount'],
                        'icon' => $iconLike,
                    ])@endcomponent
                </div>
            @endif

            {{-- 点踩 --}}
            @if ($comment['interaction']['dislikeSetting'])
                <div class="interaction-box">
                    @component('components.comment.mark.dislike', [
                        'cid' => $comment['cid'],
                        'interaction' => $comment['interaction'],
                        'count' => $comment['dislikeCount'],
                        'icon' => $iconDislike,
                    ])@endcomponent
                </div>
            @endif

            {{-- 评论 --}}
            <div class="interaction-box fresns-trigger-reply">
                <a class="btn btn-inter" href="javascript:;" role="button">
                    @if ($iconComment)
                        <img src="{{ $iconComment['imageUrl'] }}" loading="lazy">
                    @else
                        <img src="/assets/ForumX/images/icon-comment.png" loading="lazy">
                    @endif
                    {{ $comment['commentCount'] }}
                </a>
            </div>

            {{-- 分享 --}}
            <div class="interaction-box dropup">
                <button class="btn btn-inter" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @if ($iconShare)
                        <img src="{{ $iconShare['imageUrl'] }}" loading="lazy">
                    @else
                        <img src="/assets/ForumX/images/icon-share.png" loading="lazy">
                    @endif
                </button>
                @component('components.comment.mark.share', [
                    'cid' => $comment['cid'],
                    'url' => $comment['url'],
                ])@endcomponent
            </div>

            {{-- 更多 --}}
            <div class="ms-auto dropup text-end">
                <button class="btn btn-inter" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    @if ($iconMore)
                        <img src="{{ $iconMore['imageUrl'] }}" loading="lazy">
                    @else
                        <img src="/assets/ForumX/images/icon-more.png" loading="lazy">
                    @endif
                </button>
                @component('components.comment.mark.more', [
                    'cid' => $comment['cid'],
                    'uid' => $comment['author']['uid'],
                    'editControls' => $comment['editControls'],
                    'interaction' => $comment['interaction'],
                    'followCount' => $comment['followCount'],
                    'blockCount' => $comment['blockCount'],
                    'manages' => $comment['manages'],
                ])@endcomponent
            </div>
        </div>

        {{-- 回复框 --}}
        @component('components.editor.comment-box', [
            'nickname' => $comment['author']['nickname'],
            'pid' => $comment['replyToPost']['pid'],
            'cid' => $comment['cid'],
            'show' => true,
        ])@endcomponent
    </section>

    {{-- 帖子作者点赞状态 --}}
    @if ($comment['interaction']['postAuthorLikeStatus'])
        <div class="post-author-liked order-5 mt-2 mx-3">
            <span class="author-badge p-1">{{ fs_lang('contentAuthorLiked') }}</span>
        </div>
    @endif
</div>
