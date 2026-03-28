@extends('layouts.customer-app')

@section('title', '我的订单')

@section('header')
    <div class="relative">

        {{-- Mobile: App Header --}}
        <div class="md:hidden">
            {{-- Header Section --}}
            <div class="flex items-end justify-between px-2">
                <div>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight">我的订单</h2>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-1">
                        共 {{ $orders->total() }} 笔订单
                    </p>
                </div>
                <a href="{{ route('customer.book') }}"
                    class="h-11 w-11 rounded-2xl bg-slate-900 text-white flex items-center justify-center shadow-lg shadow-slate-200 active:scale-90 transition-transform">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </a>
            </div>
        </div>

        {{-- Desktop: keep original --}}
        <div class="hidden md:flex flex-col md:flex-row md:items-end md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">我的订单</h1>
                <p class="text-slate-500 font-medium mt-1">追踪您的预约记录与行程进度。</p>
            </div>

            <a href="{{ route('customer.book') }}"
                class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl bg-slate-900 text-white font-bold shadow-lg shadow-slate-200 hover:bg-slate-800 hover:-translate-y-0.5 transition-all">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                新增预约
            </a>
        </div>

    </div>
@endsection

@section('content')
    @php
        $serviceMeta = fn($v) => match ($v) {
            'big_car' => [
                'label' => '大车接送',
                'icon' =>
                    'M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12',
            ],

            'small_car' => [
                'label' => '小车接送',
                'icon' =>
                    'M16,6l3,4h2c1.11,0,2,0.89,2,2v3h-2c0,1.66-1.34,3-3,3s-3-1.34-3-3H9c0,1.66-1.34,3-3,3s-3-1.34-3-3H1v-3c0-1.11,0.89-2,2-2   l3-4H16 M10.5,7.5H6.75L4.86,10h5.64V7.5 M12,7.5V10h5.14l-1.89-2.5H12 M6,13.5c-0.83,0-1.5,0.67-1.5,1.5s0.67,1.5,1.5,1.5   s1.5-0.67,1.5-1.5S6.83,13.5,6,13.5 M18,13.5c-0.83,0-1.5,0.67-1.5,1.5s0.67,1.5,1.5,1.5s1.5-0.67,1.5-1.5S18.83,13.5,18,13.5z',
            ],

            'airport' => [
                'label' => '机场接送',
                'icon' => 'M12 19l9 2-9-18-9 18 9-2zm0 0v-8',
            ],

            'interstate' => [
                'label' => '跨州长途',
                'icon' => 'M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z',
            ],

            'designated_driver' => [
                'label' => '代驾服务',
                'icon' => 'M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z',
            ],

            'purchase' => [
                'label' => '跑腿代办',
                'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z',
            ],

            'translator' => [
                'label' => '翻译陪同',
                'icon' =>
                    'm10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802',
            ],

            default => [
                'label' => $v,
                'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
            ],
        };

        $statusConfig = fn($v) => match ($v) {
            'completed' => 'bg-emerald-100/50 text-emerald-800 border-emerald-200/60',
            'cancelled' => 'bg-rose-100/50 text-rose-800 border-rose-200/60',
            'assigned' => 'bg-blue-100/50 text-blue-800 border-blue-200/60',
            'on_the_way', 'arrived', 'in_trip' => 'bg-amber-100/55 text-amber-900 border-amber-200/60',
            default => 'bg-slate-100/70 text-slate-700 border-slate-200',
        };

        $statusText = fn($v) => match (strtolower((string) $v)) {
            'scheduled', 'booking', 'reserved' => '预约中',
            'pending' => '等待派单',
            'assigned' => '已派单',
            'on_the_way' => '司机在路上',
            'arrived' => '司机已到达',
            'in_trip' => '行程中',
            'completed' => '已完成',
            'cancelled', 'canceled' => '已取消',

            default => str_replace('_', ' ', (string) $v ?: '—'),
        };

        $paymentText = fn($v) => match (strtolower((string) $v)) {
            'cash' => '现金',
            'credit' => '挂单',
            'transfer' => '转账',
            default => $v ?: '现金',
        };
    @endphp

    {{-- Mobile: App list --}}
    <div class="md:hidden space-y-6">

        @if ($orders->count() === 0)
            {{-- Empty State (Darker) --}}
            <div
                class="bg-white rounded-[3rem] p-12 text-center shadow-[0_14px_34px_rgba(15,23,42,0.08)] border border-slate-200">
                <div class="relative mx-auto h-20 w-20 mb-6">
                    <div class="absolute inset-0 bg-slate-200/70 rounded-full animate-pulse"></div>
                    <div class="relative flex items-center justify-center h-full text-slate-400">
                        <svg class="h-10 w-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-lg font-black text-slate-900">开始您的第一段旅程</h3>
                <p class="text-sm font-bold text-slate-600 mt-2 px-4 leading-relaxed">目前没有任何订单记录，点击下方按钮开启预约。</p>
                <a href="{{ route('customer.book') }}"
                    class="mt-8 inline-block w-full py-4 rounded-2xl bg-slate-900 text-white font-black
                           shadow-[0_16px_40px_rgba(15,23,42,0.22)] active:bg-slate-800">
                    立即预约
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($orders as $o)
                    @php $meta = $serviceMeta($o->service_type); @endphp

                    <a href="{{ route('customer.orders.show', $o) }}"
                        class="block bg-white rounded-[2.5rem] p-6
                               shadow-[0_14px_34px_rgba(15,23,42,0.08)]
                               border border-slate-200
                               active:scale-[0.97] transition-all duration-300">

                        {{-- Header: Icon + Info + Status --}}
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-4">
                                <div
                                    class="h-14 w-14 rounded-3xl bg-slate-100 border border-slate-200
                                           flex items-center justify-center text-slate-900
                                           shadow-[0_10px_24px_rgba(15,23,42,0.06)]">
                                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $meta['icon'] }}" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-base font-black text-slate-900 leading-none">{{ $meta['label'] }}</h4>
                                    <p class="text-xs font-black text-slate-600 uppercase mt-1.5 tracking-tight">
                                        {{ $o->schedule_type === 'scheduled' ? '📅 ' : '⚡ ' }}
                                        {{ $o->schedule_type === 'scheduled' && $o->scheduled_at ? $o->scheduled_at->format('d M, H:i') : $o->created_at->format('M d, H:i') }}
                                    </p>
                                </div>
                            </div>
                            <span
                                class="px-3 py-1.5 rounded-xl text-[10px] font-black border-2 {{ $statusConfig($o->status) }} uppercase tracking-wider shadow-sm">
                                {{ $statusText($o->status) }}
                            </span>
                        </div>

                        {{-- Body: Visual Route --}}
                        <div class="relative pl-8 space-y-6">

                            {{-- Dash Line --}}
                            <div
                                class="absolute left-[11px] top-2 bottom-2 w-[2px] border-l-2 border-dashed border-slate-200">
                            </div>

                            {{-- Pickup --}}
                            <div class="relative">
                                <div
                                    class="absolute -left-[25px] top-1 h-4 w-4 rounded-full border-4 border-white bg-slate-400 shadow-sm">
                                </div>

                                <p class="text-xs font-black text-slate-500 uppercase tracking-wide">
                                    上车地点
                                </p>

                                <p class="text-sm font-bold text-slate-800 line-clamp-1 mt-0.5">
                                    {{ $o->pickup }}
                                </p>
                            </div>

                            {{-- Dropoffs --}}
                            @if (!empty($o->dropoffs))
                                @foreach ($o->dropoffs as $i => $point)
                                    <div class="relative">

                                        <div
                                            class="absolute -left-[25px] top-1 h-4 w-4 rounded-full border-4 border-white shadow-sm
                    {{ $loop->last ? 'bg-emerald-600' : 'bg-slate-900' }}">
                                        </div>

                                        <p class="text-xs font-black text-slate-500 uppercase tracking-wide">
                                            {{ $loop->last ? '最终目的地' : '下车点 ' . ($i + 1) }}
                                        </p>

                                        <p class="text-sm font-black text-slate-900 line-clamp-1 mt-0.5">
                                            {{ $point }}
                                        </p>

                                    </div>
                                @endforeach
                            @else
                                {{-- 旧系统兼容 --}}
                                <div class="relative">
                                    <div
                                        class="absolute -left-[25px] top-1 h-4 w-4 rounded-full border-4 border-white bg-emerald-600 shadow-sm">
                                    </div>

                                    <p class="text-xs font-black text-slate-500 uppercase tracking-wide">
                                        目的地
                                    </p>

                                    <p class="text-sm font-black text-slate-900 line-clamp-1 mt-0.5">
                                        {{ $o->dropoff }}
                                    </p>
                                </div>
                            @endif

                        </div>

                        {{-- Footer: Meta --}}
                        <div class="mt-6 pt-5 border-t border-slate-200 flex items-center justify-between">

                            {{-- 左边 Note --}}
                            <div class="flex items-center gap-2 overflow-hidden">

                                @if ($o->note)
                                    <div class="p-1.5 bg-amber-100/60 border border-amber-200/60 rounded-lg shrink-0">
                                        <svg class="h-3.5 w-3.5 text-amber-700" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7h10m-10 4h6" />
                                        </svg>
                                    </div>

                                    <p class="text-xs font-bold text-slate-700 truncate">
                                        “{{ $o->note }}”
                                    </p>
                                @else
                                    <p class="text-xs font-bold text-slate-400 italic">
                                        No note
                                    </p>
                                @endif

                            </div>

                            {{-- 右边 Payment + Amount --}}
                            <div class="flex items-center gap-3 shrink-0 ml-4">

                                {{-- Amount --}}
                                <div class="text-xs font-extrabold text-emerald-600">
                                    RM {{ number_format($o->amount ?? ($o->price ?? 0), 2) }}
                                </div>

                                {{-- Payment --}}
                                <div class="text-xs font-black uppercase text-slate-700">
                                    {{ $paymentText($o->payment_type) }}
                                </div>

                            </div>

                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Pagination (App Style) --}}
            <div class="pt-4">
                {{ $orders->links() }}
            </div>
        @endif
    </div>

    {{-- Desktop: keep your original layout --}}
    <div class="hidden md:block">
        <div
            class="bg-white border border-slate-200 rounded-[2rem] overflow-hidden shadow-[0_14px_34px_rgba(15,23,42,0.06)]">

            <div class="px-8 py-6 border-b border-slate-200 flex items-center justify-between bg-slate-100/60">
                <h2 class="font-black text-slate-900">最近预约</h2>
                <span
                    class="px-3 py-1 bg-white border border-slate-200 rounded-full text-[10px] font-black text-slate-600 uppercase tracking-widest shadow-sm">
                    共 {{ $orders->total() }} 笔
                </span>
            </div>

            @if ($orders->count() === 0)
                <div class="p-20 text-center">
                    <div
                        class="inline-flex h-16 w-16 items-center justify-center rounded-full bg-slate-100 border border-slate-200 text-slate-400 mb-4">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900">暂无行程记录</h3>
                    <p class="text-slate-600 text-sm font-bold mt-1 max-w-xs mx-auto">
                        当您完成第一次预约后，您的订单记录将会显示在这里。
                    </p>
                    <a href="{{ route('customer.book') }}"
                        class="mt-6 inline-flex items-center px-6 py-3 rounded-2xl bg-slate-900 text-white font-black hover:bg-slate-800 transition-all">
                        立即预约第一趟
                    </a>
                </div>
            @else
                <div class="divide-y divide-slate-200/60">
                    @foreach ($orders as $o)
                        @php $meta = $serviceMeta($o->service_type); @endphp
                        <div class="group px-8 py-6 hover:bg-slate-100/50 transition-colors">
                            <div class="flex flex-col lg:flex-row lg:items-center gap-6">

                                {{-- Icon & Status --}}
                                <div class="flex items-center gap-4 min-w-[140px]">
                                    <div
                                        class="h-12 w-12 shrink-0 flex items-center justify-center rounded-2xl bg-white border border-slate-200 text-slate-900
                                               shadow-[0_10px_24px_rgba(15,23,42,0.06)] group-hover:border-slate-300 transition-all">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="{{ $meta['icon'] }}" />
                                        </svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <span
                                            class="text-xs font-black text-slate-600 uppercase tracking-tight leading-none mb-1">
                                            {{ $meta['label'] }}
                                        </span>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-[10px] font-black border-2 {{ $statusConfig($o->status) }} uppercase tracking-wider">
                                            {{ $statusText($o->status) }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Route --}}
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-3">
                                        <div class="flex flex-col items-center gap-1 shrink-0">
                                            <div class="h-2 w-2 rounded-full bg-slate-400"></div>
                                            <div class="h-3 w-px bg-slate-300"></div>
                                            <div class="h-2 w-2 rounded-full bg-slate-900"></div>
                                        </div>
                                        <div class="min-w-0">
                                            <div class="text-xs font-bold text-slate-600 truncate">{{ $o->pickup }}
                                            </div>
                                            <div class="text-sm mt-3 font-black text-slate-900 truncate">
                                                {{ $o->dropoff }}</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Metadata --}}
                                <div
                                    class="grid grid-cols-2 md:grid-cols-3 lg:flex items-center gap-8 text-left lg:text-right shrink-0">
                                    <div class="flex flex-col">
                                        <span class="text-[10px] font-black text-slate-600 uppercase tracking-widest">日期 /
                                            时间</span>
                                        <span class="text-sm font-bold text-slate-800">
                                            {{ $o->schedule_type === 'scheduled' && $o->scheduled_at ? $o->scheduled_at->format('d M, h:i A') : $o->created_at->format('d M, h:i A') }}
                                        </span>
                                    </div>

                                    <div class="flex flex-col">
                                        <span
                                            class="text-[10px] font-black text-slate-600 uppercase tracking-widest">班次</span>
                                        <span
                                            class="text-sm font-bold text-slate-800 capitalize">{{ $o->shift ?? 'Day' }}</span>
                                    </div>

                                    <div class="hidden md:flex flex-col">
                                        <span
                                            class="text-[10px] font-black text-slate-600 uppercase tracking-widest">付款方式</span>
                                        <span
                                            class="text-sm font-bold text-slate-800">{{ strtoupper($paymentText($o->payment_type)) }}</span>
                                    </div>

                                    <div class="col-span-2 md:col-span-1 lg:ml-4">
                                        <a href="{{ route('customer.orders.show', $o) }}"
                                            class="inline-flex items-center justify-center h-10 px-5 rounded-xl border border-slate-200 bg-white text-sm font-black text-slate-700
                                                   hover:bg-slate-900 hover:text-white hover:border-slate-900 transition-all">
                                            查看详情
                                        </a>
                                    </div>
                                </div>

                            </div>

                            @if ($o->note)
                                <div
                                    class="mt-4 flex items-start gap-2 px-4 py-3 rounded-xl bg-slate-100/60 border border-slate-200">
                                    <svg class="h-4 w-4 text-slate-500 shrink-0 mt-0.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                    <p class="text-xs font-bold text-slate-700 italic leading-snug">备注：{{ $o->note }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="px-8 py-6 bg-slate-100/40 border-t border-slate-200">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
