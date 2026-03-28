<x-guest-layout>
    <div class="min-h-screen bg-slate-950 flex items-center justify-center px-6 py-10 relative overflow-hidden">

        {{-- Background --}}
        <div class="absolute inset-0">
            <div class="absolute -top-32 -left-20 w-96 h-96 bg-indigo-500/30 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 -right-20 w-96 h-96 bg-cyan-400/20 rounded-full blur-3xl"></div>
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-950 to-black"></div>
        </div>

        <div class="relative w-full max-w-sm">

            <div
                class="rounded-[2.5rem] bg-white/10 backdrop-blur-xl border border-white/10 shadow-[0_30px_80px_rgba(0,0,0,0.6)] px-7 py-10">

                {{-- Logo --}}
                <div class="flex justify-center">
                    <img src="{{ asset('images/galaxycarteamlogo.png') }}" class="h-28 w-28 object-contain">
                </div>

                {{-- Title --}}
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-black text-white">注册账号</h1>
                    <p class="text-sm text-slate-300 mt-1">填写资料开始使用</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    {{-- Username --}}
                    <div>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required
                            placeholder="用户名"
                            class="w-full h-14 rounded-2xl bg-white/10 border border-white/10 text-white placeholder:text-slate-400 px-5 text-sm font-semibold outline-none focus:ring-2 focus:ring-indigo-400 backdrop-blur" />
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    {{-- Full Name --}}
                    <div>
                        <input id="full_name" name="full_name" type="text" value="{{ old('full_name') }}" required
                            placeholder="真实姓名"
                            class="w-full h-14 rounded-2xl bg-white/10 border border-white/10 text-white placeholder:text-slate-400 px-5 text-sm font-semibold outline-none focus:ring-2 focus:ring-indigo-400 backdrop-blur" />
                        <x-input-error :messages="$errors->get('full_name')" class="mt-1" />
                    </div>

                    {{-- Phone --}}
                    <div>
                        <input id="phone" name="phone" type="text" value="{{ old('phone') }}" required
                            placeholder="手机号码"
                            class="w-full h-14 rounded-2xl bg-white/10 border border-white/10 text-white placeholder:text-slate-400 px-5 text-sm font-semibold outline-none focus:ring-2 focus:ring-indigo-400 backdrop-blur" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                    </div>

                    {{-- Email --}}
                    <div>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required
                            placeholder="电子邮箱"
                            class="w-full h-14 rounded-2xl bg-white/10 border border-white/10 text-white placeholder:text-slate-400 px-5 text-sm font-semibold outline-none focus:ring-2 focus:ring-indigo-400 backdrop-blur" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    {{-- Password --}}
                    <div>
                        <input id="password" name="password" type="password" required placeholder="密码"
                            class="w-full h-14 rounded-2xl bg-white/10 border border-white/10 text-white placeholder:text-slate-400 px-5 text-sm font-semibold outline-none focus:ring-2 focus:ring-indigo-400 backdrop-blur" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                            placeholder="确认密码"
                            class="w-full h-14 rounded-2xl bg-white/10 border border-white/10 text-white placeholder:text-slate-400 px-5 text-sm font-semibold outline-none focus:ring-2 focus:ring-indigo-400 backdrop-blur" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                    </div>

                    {{-- Button --}}
                    <button type="submit"
                        class="w-full h-14 rounded-2xl bg-white text-slate-900 font-black text-sm tracking-widest shadow-xl hover:scale-[1.02] active:scale-[0.97] transition">
                        注册
                    </button>
                </form>

                {{-- Footer --}}
                <div class="mt-6 text-center text-sm text-slate-300">
                    已有账号？
                    <a href="{{ route('login') }}" class="text-white font-bold hover:underline">
                        登录
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-guest-layout>
