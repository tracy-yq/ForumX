@extends('commons.fresns')

@section('title', fs_lang('accountPolicies'))

@section('content')
    <main class="container">
        <div class="d-flex align-items-start mt-3">
            <div class="nav flex-column nav-pills w-25" id="policies-tabs" role="tablist" aria-orientation="vertical">
                <div class="d-flex justify-content-between mx-3 mt-3">
                    <h1 class="fs-5">{{ fs_lang('accountPolicies') }}</h1>
                </div>
    
                @if (fs_api_config('account_terms_status'))
                    <button class="nav-link text-start rounded-0 py-3 active" id="terms-tab" data-bs-toggle="pill" data-bs-target="#account-terms" type="button" role="tab" aria-controls="terms" aria-selected="true">{{ fs_lang('accountPoliciesTerms') }}</button>
                @endif

                @if (fs_api_config('account_privacy_status'))
                    <button class="nav-link text-start rounded-0 py-3" id="privacy-tab" data-bs-toggle="pill" data-bs-target="#account-privacy" type="button" role="tab" aria-controls="privacy" aria-selected="false">{{ fs_lang('accountPoliciesPrivacy') }}</button>
                @endif

                @if (fs_api_config('account_cookies_status'))
                    <button class="nav-link text-start rounded-0 py-3" id="cookies-tab" data-bs-toggle="pill" data-bs-target="#account-cookies" type="button" role="tab" aria-controls="cookies" aria-selected="false">{{ fs_lang('accountPoliciesCookies') }}</button>
                @endif

                @if (fs_api_config('account_delete_status'))
                    <button class="nav-link text-start rounded-0 py-3" id="delete-tab" data-bs-toggle="pill" data-bs-target="#account-delete" type="button" role="tab" aria-controls="delete" aria-selected="false">{{ fs_lang('accountDelete') }}</button>
                @endif
            </div>

            <div class="tab-content border-start ps-lg-5 pb-5 account-settings" id="policies-tab-content">
                {{-- 服务条款 --}}
                <div class="tab-pane fade show active" id="account-terms" role="tabpanel" aria-labelledby="terms-tab" tabindex="0">
                    {!! fs_api_config('account_terms') ? Str::markdown(fs_api_config('account_terms')) : '' !!}
                </div>

                {{-- 隐私权政策 --}}
                <div class="tab-pane fade" id="account-privacy" role="tabpanel" aria-labelledby="privacy-tab" tabindex="0">
                    {!! fs_api_config('account_privacy') ? Str::markdown(fs_api_config('account_privacy')) : '' !!}
                </div>

                {{-- Cookies 政策 --}}
                <div class="tab-pane fade" id="account-cookies" role="tabpanel" aria-labelledby="cookies-tab" tabindex="0">
                    {!! fs_api_config('account_cookies') ? Str::markdown(fs_api_config('account_cookies')) : '' !!}
                </div>

                {{-- 注销账号 --}}
                <div class="tab-pane fade" id="account-delete" role="tabpanel" aria-labelledby="delete-tab" tabindex="0">
                    {!! fs_api_config('account_delete') ? Str::markdown(fs_api_config('account_delete')) : '' !!}
                </div>
            </div>
        </div>
    </main>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            var activeTab = window.location.hash.substring(1);
            if (!activeTab) {
                activeTab = 'terms-tab';
            }
            $('#' + activeTab).tab('show');
            document.documentElement.scrollIntoView({ behavior: 'smooth', block: 'start' });

            $('#policies-tabs button').click(function (e) {
                e.preventDefault();
                $(this).tab('show');
                document.documentElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });
    </script>
@endpush
