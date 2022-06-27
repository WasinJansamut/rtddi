<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">

            <img src="{{ asset('storage/logo.png') }}" width="100%" />

        </x-slot>

        <x-jet-validation-errors class="mb-4" />



        @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
        @endif



        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>


            <div class="mt-7">
                <button type="submit"
                    class="bg-blue-500 w-full py-3 rounded-xl text-white shadow-xl hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                    เข้าสู่ระบบ
                </button>

                {{--   <x-jet-button
                    class="ml-4 g-blue-500 w-full py-3 rounded-xl text-white shadow-xl hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                    {{ __('เข้าสู่ระบบ') }}
                </x-jet-button> --}}
            </div>

            <div class="flex mt-7 items-center text-center">
                <hr class="border-gray-300 border-1 w-full rounded-md">


            </div>

            <div class="flex mt-7 justify-center w-full">

                <a class="mr-5 bg-gray-500 border-none px-4 py-2 rounded-xl cursor-pointer text-white shadow-xl hover:shadow-inner transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105"
                    href="{{ url('') }}">
                    {{ __('<<< กลับหน้าแรก ') }}
                </a>


                <a class="bg-red-500 border-none px-4 py-2 rounded-xl cursor-pointer text-white shadow-xl hover:shadow-inner transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105"
                    href="{{ url('register') }}">
                    {{ __('ลงทะเบียนใหม่') }}
                </a>
            </div>


            <div class="flex items-center justify-end mt-4">


                {{--     @if (Route::has('password.request'))

                {{--     <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                {{ __('ลืมรหัสผ่าน?') }}
                </a>

                @endif --}}



                {{-- 
                <x-jet-button class="ml-4">
                    {{ __('เข้าสู่ระบบ') }}
                </x-jet-button>
                --}}


            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>