{{-- 文本框 --}}
@if ($extends['textBox'])
    @foreach($extends['textBox'] as $extend)
        <div class="position-relative frame-box-text">
            <div class="frame-text-content">
                {{ $extend['content'] }}
            </div>
            {{-- 页面类型 --}}
            @if ($extend['accessUrl'])
                <a class="text-decoration-none stretched-link" data-bs-toggle="modal" href="#fresnsModal"
                    data-type="post"
                    data-scene="extendBox"
                    data-post-message-key="fresnsPostExtendBox"
                    data-pid="{{ $pid }}"
                    data-uid="{{ $author['uid'] }}"
                    data-title="{{ $extend['title'] }}"
                    data-url="{{ $extend['accessUrl'] }}">
                </a>
            @endif
        </div>
    @endforeach
@endif

{{-- 信息框 --}}
@if ($extends['infoBox'])
    @foreach($extends['infoBox'] as $extend)
        <div class="position-relative frame-box-info mb-3">
            <div class="d-flex align-items-center">
                {{-- 封面图 --}}
                <div class="flex-shrink-0">
                    <img src="{{ $extend['cover'] }}" loading="lazy" class="frame-image-{{ $extend['infoBoxTypeString'] }}">
                </div>

                <div class="flex-grow-1 px-3">
                    <div class="d-flex flex-column frame-box-{{ $extend['infoBoxTypeString'] }}">
                        <div class="frame-title" style="color:{{ $extend['titleColor'] }}">{{ $extend['title'] }}</div>

                        @if ($extend['descPrimary'])
                            <div class="frame-desc mt-auto" style="color:{{ $extend['descPrimaryColor'] }}">{{ $extend['descPrimary'] }}</div>
                        @endif
                        @if ($extend['descSecondary'])
                            <div class="frame-desc mt-auto" style="color:{{ $extend['descSecondaryColor'] }}">{{ $extend['descSecondary'] }}</div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- 按钮 --}}
            @if ($extend['btnName'])
                <div class="position-absolute top-50 end-0 translate-middle-y">
                    <a href="#" role="button" class="btn btn-info btn-sm me-3" style="background-color:{{ $extend['btnColor'] }};border-color:{{ $extend['btnColor'] }}">{{ $extend['btnName'] }}</a>
                </div>
            @endif

            @if ($extend['accessUrl'])
                <a class="text-decoration-none stretched-link" data-bs-toggle="modal" href="#fresnsModal"
                    data-type="post"
                    data-scene="extendBox"
                    data-post-message-key="fresnsPostExtendBox"
                    data-pid="{{ $pid }}"
                    data-uid="{{ $author['uid'] }}"
                    data-title="{{ $extend['title'] }}"
                    data-url="{{ $extend['accessUrl'] }}">
                </a>
            @endif
        </div>
    @endforeach
@endif
