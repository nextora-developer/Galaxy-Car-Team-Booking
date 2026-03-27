@extends('layouts.customer-app')

{{-- @if ($activeBooking)
    <meta http-equiv="refresh" content="10">
@endif --}}

@section('title', '首页')

@section('header')
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <div class="space-y-1">
            <div class="flex items-center gap-2 justify-center md:justify-start">
                <span class="relative flex h-2 w-2">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                    你好，{{ explode(' ', auth()->user()->name)[0] }}！
                </h1>
            </div>
            <p class="text-slate-500 font-medium text-sm sm:text-base text-center md:text-left">
                今天想去哪里？您的专属车队已准备就绪。
            </p>
        </div>

        <div class="flex justify-center md:justify-end">
            <a href="{{ route('customer.book') }}"
                class="group w-full md:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 rounded-2xl bg-slate-900 text-white font-bold transition-all duration-300 hover:bg-slate-800 hover:shadow-xl hover:shadow-slate-200 hover:-translate-y-0.5 active:translate-y-0">
                <svg class="h-5 w-5 transition-transform group-hover:rotate-90" fill="none" viewBox="0 0 24 24"
                    stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>立即预约</span>
            </a>
        </div>
    </div>
@endsection

@section('content')

    {{-- Stats Grid --}}
    <div class="grid grid-cols-3 gap-3 sm:gap-6 mb-10">
        @php
            $stats = [
                [
                    'label' => '总行程',
                    'value' => $totalTrips ?? 0,
                    'color' => 'indigo',
                    'icon' =>
                        'M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-.856.12-1.683.342-2.466',
                ],
                [
                    'label' => '进行中',
                    'value' => $inProgress ?? 0,
                    'color' => 'amber',
                    'icon' => 'M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z',
                ],
                [
                    'label' => '已完成',
                    'value' => $completed ?? 0,
                    'color' => 'emerald',
                    'icon' => 'M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z',
                ],
            ];
        @endphp

        @foreach ($stats as $stat)
            <div class="bg-white border border-slate-100 rounded-[2rem] p-4 sm:p-6 shadow-sm ring-1 ring-slate-200/50">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-[10px] sm:text-[11px] font-black text-slate-400 uppercase tracking-widest">
                        {{ $stat['label'] }}
                    </span>

                    <div
                        class="p-1.5 sm:p-2 
                        bg-{{ $stat['color'] }}-50 
                        rounded-lg sm:rounded-xl 
                        text-{{ $stat['color'] }}-500">
                        <svg class="h-3.5 w-3.5 sm:h-4 sm:w-4" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $stat['icon'] }}" />
                        </svg>
                    </div>
                </div>

                <div class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight">
                    {{ $stat['value'] }}
                </div>
            </div>
        @endforeach
    </div>

    <div id="activeRideWrap">
        @include('customer.partials.active-ride', ['activeBooking' => $activeBooking ?? null])
    </div>

    {{-- Services Section --}}
    <div class="mb-10">
        <div class="flex items-center justify-between mb-6 px-1">
            <h2 class="text-xl font-black text-slate-900 tracking-tight">精选服务</h2>
            <div class="h-px flex-1 mx-4 bg-slate-100 hidden sm:block"></div>
            {{-- <a href="#" class="text-sm font-bold text-indigo-600 hover:text-indigo-700 transition-colors">
                查看全部
            </a> --}}
        </div>

        @php
            $services = [
                [
                    'name' => '大车接送',
                    'desc' => '多人出行，商务级舒适用车，适合接送与包车服务',
                    'icon' => 'M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12',
                    'theme' => 'bg-blue-50 text-blue-600',
                ],
                [
                    'name' => '小车接送',
                    'desc' => '日常出行接送，快速直达目的地',
                    'icon' => 'M16,6l3,4h2c1.11,0,2,0.89,2,2v3h-2c0,1.66-1.34,3-3,3s-3-1.34-3-3H9c0,1.66-1.34,3-3,3s-3-1.34-3-3H1v-3c0-1.11,0.89-2,2-2   l3-4H16 M10.5,7.5H6.75L4.86,10h5.64V7.5 M12,7.5V10h5.14l-1.89-2.5H12 M6,13.5c-0.83,0-1.5,0.67-1.5,1.5s0.67,1.5,1.5,1.5   s1.5-0.67,1.5-1.5S6.83,13.5,6,13.5 M18,13.5c-0.83,0-1.5,0.67-1.5,1.5s0.67,1.5,1.5,1.5s1.5-0.67,1.5-1.5S18.83,13.5,18,13.5z',
                    'theme' => 'bg-cyan-50 text-cyan-600',
                ],
                [
                    'name' => '机场接送',
                    'desc' => '机场接机送机，行程更省心',
                    'icon' => 'M12 19l9 2-9-18-9 18 9-2zm0 0v-8',
                    'theme' => 'bg-sky-50 text-sky-600',
                ],
                [
                    'name' => '跨州长途接送',
                    'desc' => '跨州或长途出行，舒适方便',
                    'icon' => 'M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z',
                    'theme' => 'bg-amber-50 text-amber-600',
                ],
                [
                    'name' => '代驾服务',
                    'desc' => '安全护送回程，放心出行',
                    'icon' => 'M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z',
                    'theme' => 'bg-emerald-50 text-emerald-600',
                ],
                [
                    'name' => '跑腿代办',
                    'desc' => '代办事项、代买代送更方便',
                    'icon' =>
                        'M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z',
                    'theme' => 'bg-rose-50 text-rose-600',
                ],
                [
                    'name' => '翻译陪同',
                    'desc' => '出行沟通协助，陪同更安心',
                    'icon' =>
                        'm10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802',
                    'theme' => 'bg-violet-50 text-violet-600',
                ],
            ];
        @endphp

        <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($services as $service)
                <a href="{{ route('customer.book') }}"
                    class="group relative bg-white rounded-[2rem] p-6 border border-slate-100 shadow-sm transition-all duration-300 hover:shadow-2xl hover:shadow-slate-200 hover:-translate-y-2 ring-1 ring-slate-200/50">
                    <div class="flex flex-col gap-4">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-2xl {{ $service['theme'] }} group-hover:scale-110 transition-transform duration-300">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $service['icon'] }}" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-black text-slate-900 group-hover:text-indigo-600 transition-colors">
                                {{ $service['name'] }}
                            </h3>
                            <p class="text-xs text-slate-400 font-bold mt-1 line-clamp-1">
                                {{ $service['desc'] }}
                            </p>
                        </div>
                    </div>

                    {{-- Arrow indicator that appears on hover --}}
                    <div
                        class="absolute bottom-6 right-6 opacity-0 group-hover:opacity-100 transition-all group-hover:translate-x-1">
                        <svg class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection

{{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        const wrap = document.getElementById('activeRideWrap');
        if (!wrap) return;

        let pollingTimer = null;
        let isRequesting = false;

        function startPolling() {
            if (pollingTimer) return;
            pollingTimer = setInterval(refreshActiveRide, 3000);
        }

        function stopPolling() {
            if (pollingTimer) {
                clearInterval(pollingTimer);
                pollingTimer = null;
            }
        }

        async function refreshActiveRide() {
            if (document.hidden) return;
            if (isRequesting) return;

            isRequesting = true;

            try {
                const res = await fetch("{{ route('customer.active.ride') }}", {
                    headers: {
                        "X-Requested-With": "XMLHttpRequest",
                        "Accept": "text/html"
                    },
                    cache: "no-store"
                });

                if (!res.ok) return;

                const html = await res.text();
                wrap.innerHTML = html;
            } catch (e) {
                console.error('active ride refresh failed:', e);
            } finally {
                isRequesting = false;
            }
        }

        refreshActiveRide();
        startPolling();

        document.addEventListener('visibilitychange', function() {
            if (!document.hidden) {
                refreshActiveRide();
            }
        });

        window.addEventListener('beforeunload', function() {
            stopPolling();
        });
    });
</script> --}}

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const wrap = document.getElementById('activeRideWrap');
        if (!wrap) return;

        let pollingTimer = null;
        let isRequesting = false;
        let completionAlertShown = false;

        function hasActiveRide() {
            return wrap.querySelector('[data-has-active-ride="1"]') !== null;
        }

        function startPolling() {
            if (pollingTimer) return;
            pollingTimer = setInterval(refreshActiveRide, 3000);
        }

        function stopPolling() {
            if (pollingTimer) {
                clearInterval(pollingTimer);
                pollingTimer = null;
            }
        }

        async function refreshActiveRide() {
            if (document.hidden) return;
            if (isRequesting) return;

            isRequesting = true;

            const hadActiveRide = hasActiveRide();

            try {
                const res = await fetch("{{ route('customer.active.ride') }}", {
                    headers: {
                        "X-Requested-With": "XMLHttpRequest",
                        "Accept": "text/html"
                    },
                    cache: "no-store"
                });

                if (!res.ok) return;

                const html = await res.text();
                wrap.innerHTML = html;

                const hasRideNow = hasActiveRide();

                // 原本有单，现在没单 = 行程结束
                if (hadActiveRide && !hasRideNow && !completionAlertShown) {
                    completionAlertShown = true;
                    stopPolling();

                    if (typeof Swal === 'undefined') {
                        alert('行程已完成');
                        window.location.reload();
                        return;
                    }

                    Swal.fire({
                        icon: 'success',
                        title: '行程已完成 🎉',
                        text: '感谢您的使用！',
                        confirmButtonColor: '#0f172a',
                        confirmButtonText: '好的'
                    }).then(() => {
                        window.location.reload();
                    });

                    return;
                }

            } catch (e) {
                console.error('active ride refresh failed:', e);
            } finally {
                isRequesting = false;
            }
        }

        refreshActiveRide();
        startPolling();

        document.addEventListener('visibilitychange', function() {
            if (!document.hidden) {
                refreshActiveRide();
            }
        });

        window.addEventListener('beforeunload', function() {
            stopPolling();
        });
    });
</script>
