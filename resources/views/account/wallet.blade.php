@extends('commons.fresns')

@section('title', fs_db_config('menu_account_wallet'))

@section('content')
    <main class="container">
        <div class="row mt-3">
            {{-- 左侧边栏 --}}
            <div class="col-sm-3">
                @include('account.sidebar')
            </div>

            {{-- 账号内容 --}}
            <div class="col-sm-9">
                <div class="card hstack p-3 mb-3">
                    <div class="">{{ fs_account('detail.wallet.currencyCode') }} {{ fs_account('detail.wallet.balance') }}</div>
                    <div class="vr mx-3"></div>
                    <div class="btn-group">
                        @if (fs_account('items.walletRecharges'))
                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">{{ fs_lang('walletRecharge') }}</button>
                            <ul class="dropdown-menu">
                                @foreach(fs_account('items.walletRecharges') as $item)
                                    <li>
                                        <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                                            data-type="account"
                                            data-scene="walletRecharge"
                                            data-post-message-key="fresnsWalletRecharge"
                                            data-aid="{{ fs_account('detail.aid') }}"
                                            data-uid="{{ fs_user('detail.uid') }}"
                                            data-title="{{ $item['name'] }}"
                                            data-url="{{ $item['url'] }}">
                                            {{ $item['name'] }}
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <button type="button" class="btn btn-primary" disabled>{{ fs_lang('walletRecharge') }}</button>
                        @endif
                    </div>
                    <div class="vr mx-3"></div>
                    <div class="btn-group">
                        @if (fs_account('items.walletWithdraws'))
                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">{{ fs_lang('walletWithdraw') }}</button>
                            <ul class="dropdown-menu">
                                @foreach(fs_account('items.walletWithdraws') as $item)
                                    <li>
                                        <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                                            data-type="account"
                                            data-scene="walletWithdraw"
                                            data-post-message-key="fresnsWalletWithdraw"
                                            data-aid="{{ fs_account('detail.aid') }}"
                                            data-uid="{{ fs_user('detail.uid') }}"
                                            data-title="{{ $item['name'] }}"
                                            data-url="{{ $item['url'] }}">
                                            {{ $item['name'] }}
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <button type="button" class="btn btn-primary" disabled>{{ fs_lang('walletWithdraw') }}</button>
                        @endif
                    </div>
                </div>

                {{-- 交易记录 --}}
                <div class="card">
                    <div class="card-header">
                        {{ fs_lang('walletLogs') }}
                    </div>
                    <div class="card-body">
                        <table class="table table-hover align-middle text-nowrap">
                            <thead>
                                <tr class="table-info">
                                    <th scope="col">{{ fs_lang('walletLogType') }}</th>
                                    <th scope="col">{{ fs_lang('walletLogAmountTotal') }}</th>
                                    <th scope="col">{{ fs_lang('walletLogAmount') }}</th>
                                    <th scope="col">{{ fs_lang('walletLogSystemFee') }}</th>
                                    <th scope="col">{{ fs_lang('walletLogOpeningBalance') }}</th>
                                    <th scope="col">{{ fs_lang('walletLogClosingBalance') }}</th>
                                    <th scope="col">{{ fs_lang('walletLogTime') }}</th>
                                    <th scope="col">{{ fs_lang('walletLogRemark') }}</th>
                                    <th scope="col">{{ fs_lang('walletLogUser') }}</th>
                                    <th scope="col">{{ fs_lang('walletLogState') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logs as $log)
                                    <tr>
                                        <th scope="row">{{ fs_lang("walletLogType{$log['type']}") }}</th>
                                        <td>{{ $log['amountTotal'] }}</td>
                                        <td>{{ $log['transactionAmount'] }}</td>
                                        <td>{{ $log['systemFee'] }}</td>
                                        <td>{{ $log['openingBalance'] }}</td>
                                        <td>{{ $log['closingBalance'] }}</td>
                                        <td>
                                            <time class="text-secondary" datetime="{{ $log['datetime'] }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $log['datetime'] }}">
                                                {{ $log['timeAgo'] }}
                                            </time>
                                        </td>
                                        <td>{{ $log['remark'] }}</td>
                                        <td>
                                            @if ($log['user'])
                                                @if ($log['user']['status'])
                                                    <a href="{{ fs_route(route('fresns.profile.index', ['uidOrUsername' => $log['user']['fsid']])) }}">
                                                        <img src="{{ $log['user']['avatar'] }}" loading="lazy" class="rounded-circle" width="24" height="24">
                                                        {{ $log['user']['nickname'] }}
                                                    </a>
                                                @else
                                                    {{-- Deactivate --}}
                                                    <img src="{{ fs_api_config('deactivate_avatar') }}" loading="lazy" alt="{{ fs_lang('userDeactivate') }}" class="user-avatar rounded-circle">
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{ fs_lang("walletLogState{$log['state']}") }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="my-3 table-responsive">
                            {{ $logs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
