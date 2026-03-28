<x-guest-layout>
    <div class="min-h-screen bg-slate-950 flex items-center justify-center px-6 py-10 relative overflow-hidden">

        {{-- Background --}}
        <div class="absolute inset-0">
            <div class="absolute -top-32 -left-20 w-96 h-96 bg-indigo-500/30 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 -right-20 w-96 h-96 bg-cyan-400/20 rounded-full blur-3xl"></div>
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-950 to-black"></div>
        </div>

        <div class="relative w-full max-w-md">
            <div
                class="rounded-[2.5rem] bg-white/10 backdrop-blur-xl border border-white/10 shadow-[0_30px_80px_rgba(0,0,0,0.6)] px-7 py-10">

                {{-- Logo --}}
                <div class="flex justify-center">
                    <img src="{{ asset('images/galaxycarteamlogo.png') }}" alt="Galaxy Car Team Logo"
                        class="h-28 w-28 object-contain">
                </div>

                {{-- Header --}}
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-black text-white">司机注册</h1>
                    <p class="text-sm text-slate-300 mt-1">创建你的司机账号</p>
                </div>

                {{-- Global errors --}}
                @if ($errors->any())
                    <div class="mb-6 rounded-2xl border border-rose-400/20 bg-rose-500/10 px-4 py-3 backdrop-blur">
                        <div class="text-xs font-black text-rose-200 uppercase tracking-widest mb-1">
                            请修正以下错误
                        </div>
                        <ul class="text-sm font-semibold text-rose-100 list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('driver.register.store') }}" class="space-y-5">
                    @csrf

                    {{-- Username --}}
                    <div>
                        <input name="name" type="text" required value="{{ old('name') }}"
                            placeholder="用户名 / 显示名称"
                            class="w-full h-14 rounded-2xl bg-white/10 border border-white/10 text-white placeholder:text-slate-400 px-5 text-sm font-semibold outline-none focus:ring-2 focus:ring-indigo-400 backdrop-blur" />
                        @error('name')
                            <p class="mt-1 ml-1 text-sm font-semibold text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Full Name --}}
                    <div>
                        <input name="full_name" type="text" required value="{{ old('full_name') }}"
                            placeholder="姓名（与身份证一致）"
                            class="w-full h-14 rounded-2xl bg-white/10 border border-white/10 text-white placeholder:text-slate-400 px-5 text-sm font-semibold outline-none focus:ring-2 focus:ring-indigo-400 backdrop-blur" />
                        @error('full_name')
                            <p class="mt-1 ml-1 text-sm font-semibold text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- IC Number --}}
                    <div>
                        <input name="ic_number" type="text" required value="{{ old('ic_number') }}"
                            placeholder="身份证号码（IC / NRIC）"
                            class="w-full h-14 rounded-2xl bg-white/10 border border-white/10 text-white placeholder:text-slate-400 px-5 text-sm font-semibold outline-none focus:ring-2 focus:ring-indigo-400 backdrop-blur" />
                        @error('ic_number')
                            <p class="mt-1 ml-1 text-sm font-semibold text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Phone --}}
                    <div>
                        <input name="phone" type="text" required value="{{ old('phone') }}"
                            placeholder="手机号码"
                            class="w-full h-14 rounded-2xl bg-white/10 border border-white/10 text-white placeholder:text-slate-400 px-5 text-sm font-semibold outline-none focus:ring-2 focus:ring-indigo-400 backdrop-blur" />
                        @error('phone')
                            <p class="mt-1 ml-1 text-sm font-semibold text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <input name="email" type="email" required value="{{ old('email') }}"
                            placeholder="电子邮箱"
                            class="w-full h-14 rounded-2xl bg-white/10 border border-white/10 text-white placeholder:text-slate-400 px-5 text-sm font-semibold outline-none focus:ring-2 focus:ring-indigo-400 backdrop-blur" />
                        @error('email')
                            <p class="mt-1 ml-1 text-sm font-semibold text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Car Plate --}}
                    <div>
                        <input name="car_plate" type="text" required value="{{ old('car_plate') }}"
                            placeholder="车牌号码"
                            class="w-full h-14 rounded-2xl bg-white/10 border border-white/10 text-white placeholder:text-slate-400 px-5 text-sm font-semibold outline-none focus:ring-2 focus:ring-indigo-400 backdrop-blur" />
                        @error('car_plate')
                            <p class="mt-1 ml-1 text-sm font-semibold text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Car Model --}}
                    <div>
                        <input name="car_model" type="text" required value="{{ old('car_model') }}"
                            placeholder="车辆型号"
                            class="w-full h-14 rounded-2xl bg-white/10 border border-white/10 text-white placeholder:text-slate-400 px-5 text-sm font-semibold outline-none focus:ring-2 focus:ring-indigo-400 backdrop-blur" />
                        @error('car_model')
                            <p class="mt-1 ml-1 text-sm font-semibold text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Bank Name --}}
                    <div>
                        <input name="bank_name" type="text" required value="{{ old('bank_name') }}"
                            placeholder="银行名称"
                            class="w-full h-14 rounded-2xl bg-white/10 border border-white/10 text-white placeholder:text-slate-400 px-5 text-sm font-semibold outline-none focus:ring-2 focus:ring-indigo-400 backdrop-blur" />
                        @error('bank_name')
                            <p class="mt-1 ml-1 text-sm font-semibold text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Bank Account --}}
                    <div>
                        <input name="bank_account" type="text" required value="{{ old('bank_account') }}"
                            placeholder="银行账号"
                            class="w-full h-14 rounded-2xl bg-white/10 border border-white/10 text-white placeholder:text-slate-400 px-5 text-sm font-semibold outline-none focus:ring-2 focus:ring-indigo-400 backdrop-blur" />
                        @error('bank_account')
                            <p class="mt-1 ml-1 text-sm font-semibold text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Shift --}}
                    <div>
                        <select name="shift" required
                            class="w-full h-14 rounded-2xl bg-white/10 border border-white/10 text-white px-5 text-sm font-semibold outline-none focus:ring-2 focus:ring-indigo-400 backdrop-blur">
                            <option value="" class="text-slate-900">请选择班次</option>
                            <option value="day" class="text-slate-900" {{ old('shift') === 'day' ? 'selected' : '' }}>早班</option>
                            <option value="night" class="text-slate-900" {{ old('shift') === 'night' ? 'selected' : '' }}>晚班</option>
                        </select>
                        @error('shift')
                            <p class="mt-1 ml-1 text-sm font-semibold text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <input name="password" type="password" required placeholder="密码"
                            class="w-full h-14 rounded-2xl bg-white/10 border border-white/10 text-white placeholder:text-slate-400 px-5 text-sm font-semibold outline-none focus:ring-2 focus:ring-indigo-400 backdrop-blur" />
                        @error('password')
                            <p class="mt-1 ml-1 text-sm font-semibold text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <input name="password_confirmation" type="password" required placeholder="确认密码"
                            class="w-full h-14 rounded-2xl bg-white/10 border border-white/10 text-white placeholder:text-slate-400 px-5 text-sm font-semibold outline-none focus:ring-2 focus:ring-indigo-400 backdrop-blur" />
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full h-14 rounded-2xl bg-white text-slate-900 font-black text-sm tracking-widest shadow-xl hover:scale-[1.02] active:scale-[0.97] transition">
                        注册成为司机
                    </button>
                </form>

                {{-- Footer --}}
                <div class="mt-6 text-center text-sm text-slate-300">
                    已经注册？
                    <a href="{{ route('driver.login') }}" class="text-white font-bold hover:underline">
                        登录
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>