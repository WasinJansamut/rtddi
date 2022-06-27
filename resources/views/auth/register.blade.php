<x-guest-layout>

    <x-jet-authentication-card>

        <x-slot name="logo">
            <img src="{{ asset('storage/logo.png') }}" width="100%" />
            {{-- <x-jet-authentication-card-logo /> --}} <br>
            <h2 class="text-2xl text-gray-900 text-center">ลงทะเบียนผู้ใช้งาน</h2>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />



        <form method="POST" action="{{ route('register') }}">
            @csrf



            <span class="flex items-center justify-center space-x-2">
                <span class="h-px bg-gray-400 w-14"></span>
                <span class="font-normal text-gray-500">ข้อมูลสำหรับเข้าสู่ระบบ</span>
                <span class="h-px bg-gray-400 w-14"></span>
            </span>


            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    autofocus required />
            </div>



            <div class="flex justify-between gap-3">
                <span class="w-1/2">
                    <x-jet-label for="password" value="{{ __('Password (8ตัวอักษรขึ้นไป)') }}" />
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />
                </span>
                <span class="w-1/2">
                    <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                </span>
            </div>

            <br>

            <span class="flex items-center justify-center space-x-2">
                <span class="h-px bg-gray-400 w-14"></span>
                <span class="font-normal text-gray-500">ข้อมูลบัญชี</span>
                <span class="h-px bg-gray-400 w-14"></span>
            </span>


            <div>
                <x-jet-label for="name" value="{{ __('ชื่อ-สกุล') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required />
            </div>


            <div class="flex justify-between gap-3">
                <span class="w-1/2">
                    <x-jet-label for="position" value="{{ __('ตำแหน่ง') }}" />
                    <x-jet-input id="position" class="block mt-1 w-full" type="text" name="position"
                        :value="old('position')" />
                </span>
                <span class="w-1/2">
                    <x-jet-label for="department" value="{{ __('หน่วยงาน') }}" />
                    <x-jet-input id="department" class="block mt-1 w-full" type="text" name="department"
                        :value="old('department')" />
                </span>
            </div>


            <div>
                <x-jet-label for="tel" value="{{ __('เบอร์โทรศัพท์ที่ติดต่อได้') }}" />
                <x-jet-input id="tel" class="block mt-1 w-full" type="text" name="tel" :value="old('tel')" />
            </div>

            <div>
                <x-jet-label for="type" value="{{ __('ประเภทผู้ใช้งาน *') }}" />
                {{--  <x-jet-input id="type" class="block mt-1 w-full" type="text" name="type" /> --}}

                <select name="type" id="type" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                    <option value="" selected>--กรุณาเลือก--</option>
                    <option value="admin">ผู้ดูแลระบบ</option>
                    <option value="officer">เจ้าหน้าที่กองป้องกันการบาดเจ็บ</option>
                    <option value="police">ตำรวจ</option>
                    <option value="eclaim">บริษัทกลางคุ้มครองผู้ประสบภัยจากรถ</option>
                    <option value="deathcert">กองยุทธศาสตร์และแผนงาน (มรณบัตร)</option>
                </select>

            </div>





            <x-jet-input id="status" class="block mt-1 w-full hidden" type="text" name="status" :value="0" />
            {{--  <div>
                <x-jet-label for="status" value="{{ __('status') }}" />
            <x-jet-input id="status" class="block mt-1 w-full" type="text" name="status" :value="old('status')" />
            </div> --}}



            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-4">
                <x-jet-label for="terms">
                    <div class="flex items-center">
                        <x-jet-checkbox name="terms" id="terms" />

                        <div class="ml-2">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'"
                                class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of
                                Service').'</a>',
                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'"
                                class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy
                                Policy').'</a>',
                            ]) !!}
                        </div>
                    </div>
                </x-jet-label>
            </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                {{--  <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Already registered?') }}
                </a> --}}


                {{--    <a >
                {{ __('ย้อนกลับ') }}
                </a> --}}

                <a href="javascript:history.back()" class="underline text-sm text-gray-600 hover:text-gray-900"
                    href="{{ url('/users') }}">ย้อนกลับ</a>

                <x-jet-button class="ml-4">
                    {{ __('ลงทะเบียน') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>