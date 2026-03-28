<x-guest-layout>
    <div class="min-h-screen bg-slate-950 flex items-center justify-center px-6 py-10 relative overflow-hidden">

        {{-- Background --}}
        <div class="absolute inset-0">
            <div class="absolute -top-32 -left-20 w-96 h-96 bg-blue-600/25 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 -right-20 w-96 h-96 bg-cyan-400/20 rounded-full blur-3xl"></div>
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-950 to-black"></div>
        </div>

        <div class="relative w-full max-w-sm">
            <div
                class="rounded-[2.5rem] bg-white/10 backdrop-blur-xl border border-white/10 shadow-[0_30px_80px_rgba(0,0,0,0.6)] px-7 py-10">

                {{-- Logo --}}
                <div class="flex justify-center">
                    <img src="{{ asset('images/galaxycarteamlogo.png') }}" alt="Galaxy Car Team Logo"
                        class="h-28 w-28 object-contain">
                </div>

                {{-- Header --}}
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-black text-white tracking-tight">
                        管理员登录
                    </h1>
                    <p class="text-sm text-slate-300 mt-1">
                        受限制的控制面板
                    </p>
                </div>

                <form method="POST" action="{{ route('admin.login.store') }}" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <input type="email" name="email" required value="{{ old('email') }}"
                            placeholder="管理员邮箱"
                            class="w-full h-14 rounded-2xl bg-white/10 border border-white/10 text-white placeholder:text-slate-400 px-5 text-sm font-semibold outline-none focus:ring-2 focus:ring-blue-400 backdrop-blur" />
                    </div>

                    {{-- Password --}}
                    <div>
                        <input type="password" name="password" required
                            placeholder="密码"
                            class="w-full h-14 rounded-2xl bg-white/10 border border-white/10 text-white placeholder:text-slate-400 px-5 text-sm font-semibold outline-none focus:ring-2 focus:ring-blue-400 backdrop-blur" />
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full h-14 rounded-2xl bg-white text-slate-900 font-black text-sm tracking-widest shadow-xl hover:scale-[1.02] active:scale-[0.97] transition">
                        管理员登录
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-guest-layout>