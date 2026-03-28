<x-guest-layout>
    <div class="min-h-screen bg-slate-950 flex items-center justify-center px-6 py-10 relative overflow-hidden">

        {{-- Background --}}
        <div class="absolute inset-0">
            <div class="absolute -top-32 -left-20 w-96 h-96 bg-indigo-500/30 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 -right-20 w-96 h-96 bg-cyan-400/20 rounded-full blur-3xl"></div>
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-950 to-black"></div>
        </div>

        {{-- Card --}}
        <div class="relative w-full max-w-sm">

            <div
                class="rounded-[2.5rem] bg-white/10 backdrop-blur-xl border border-white/10 shadow-[0_30px_80px_rgba(0,0,0,0.6)] px-7 py-10">

                {{-- Logo --}}
                <div class="flex justify-center">
                    <div class="relative">
                        <img src="{{ asset('images/galaxycarteamlogo.png') }}" class="h-32 w-32 object-contain">

                    </div>
                </div>

                {{-- Title --}}
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-black text-white">欢迎回来</h1>
                    <p class="text-sm text-slate-300 mt-1">登录你的账号继续使用</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <div class="relative">
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required
                                placeholder="电子邮箱"
                                class="w-full h-14 rounded-2xl bg-white/10 border border-white/10 text-white placeholder:text-slate-400 px-5 text-sm font-semibold outline-none focus:ring-2 focus:ring-indigo-400 backdrop-blur" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    {{-- Password --}}
                    <div>
                        <div class="relative">
                            <input id="password" name="password" type="password" required placeholder="密码"
                                class="w-full h-14 rounded-2xl bg-white/10 border border-white/10 text-white placeholder:text-slate-400 px-5 text-sm font-semibold outline-none focus:ring-2 focus:ring-indigo-400 backdrop-blur" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    {{-- Remember --}}
                    <div class="flex items-center justify-between text-sm text-slate-300">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember"
                                class="rounded border-white/20 bg-white/10 text-indigo-500 focus:ring-indigo-500">
                            记住我
                        </label>
                    </div>

                    {{-- Button --}}
                    <button type="submit"
                        class="w-full h-14 rounded-2xl bg-white text-slate-900 font-black text-sm tracking-widest shadow-xl hover:scale-[1.02] active:scale-[0.97] transition">
                        登录
                    </button>
                </form>

                {{-- Register --}}
                <div class="mt-6 text-center text-sm text-slate-300">
                    还没有账号？
                    <a href="{{ route('register') }}" class="text-white font-bold hover:underline">
                        注册
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-guest-layout>
