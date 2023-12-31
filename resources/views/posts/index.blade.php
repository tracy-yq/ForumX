@extends('commons.fresns')

@section('title', fs_db_config('menu_post_title'))
@section('keywords', fs_db_config('menu_post_keywords'))
@section('description', fs_db_config('menu_post_description'))

@section('content')
    <main class="container">
        <div class="row mt-3">
            {{-- 左侧边栏 --}}
            <div class="col-sm-3">
                @include('posts.sidebar')
            </div>

            {{-- 中间内容 --}}
            <div class="col-sm-6">
                {{-- 置顶帖子列表 --}}
                @if (fs_sticky_posts())
                    <div class="list-group mb-4">
                        @foreach(fs_sticky_posts() as $sticky)
                            @component('components.post.sticky', compact('sticky'))@endcomponent
                        @endforeach
                    </div>
                @endif

                {{-- 帖子列表 --}}
                <article class="card clearfix">
                    @foreach($posts as $post)
                        @component('components.post.list', compact('post'))@endcomponent
                        @if (! $loop->last)
                            <hr>
                        @endif
                    @endforeach
                </article>

                {{-- 列表页码 --}}
                @if (fs_db_config('menu_post_query_state') != 1)
                    <div class="my-3 table-responsive">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>

            {{-- 右侧边栏 --}}
            <div class="col-sm-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
