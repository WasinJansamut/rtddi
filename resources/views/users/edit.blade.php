@section('title','ข้อมูลผู้ใช้')
@section('subtitle',Request::path() )
<x-app-layout>

    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">จัดการข้อมูลผู้ใช้งาน</h3>


        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">

                    @if ($errors->any())
                    <div class="px-4 py-3 leading-normal text-white-700 bg-red-100 rounded-lg" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif


                    <!--Card-->
                    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">


                        <!--
  This example requires Tailwind CSS v2.0+ 
  
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ]
  }
  ```
-->
                        <div>
                            <div class="md:grid md:grid-cols-3 md:gap-6">
                                <div class="md:col-span-1">
                                    <div class="px-4 sm:px-0">
                                        <h3 class="text-lg font-medium leading-6 text-gray-900">ข้อมูลเข้าระบบ</h3>
                                        <p class="mt-1 text-sm text-gray-600">
                                            Information
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-5 md:mt-0 md:col-span-2">
                                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                                            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                                <div class="grid grid-cols-3 gap-6">
                                                    <div class="col-span-3 sm:col-span-2">
                                                        <label for="company_website"
                                                            class="block text-sm font-medium text-gray-700">
                                                            Email
                                                        </label>
                                                        <div class="mt-1 flex rounded-md shadow-sm">

                                                            <input type="Email" name="email" id="email"
                                                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                                                value="{{$user->email ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>
                                                    <label for="about" class="block text-sm font-medium text-gray-700">
                                                        ชื่อ-สกุล
                                                    </label>
                                                    <div class="mt-1">
                                                        <input type="text" name="name" id="name"
                                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                                            value="{{$user->name ?? ''}}">
                                                    </div>

                                                </div>


                                                <div>
                                                    <label for="about" class="block text-sm font-medium text-gray-700">
                                                        ตำแหน่ง
                                                    </label>
                                                    <div class="mt-1">
                                                        <input type="text" name="position" id="position"
                                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                                            value="{{$user->position ?? ''}}">
                                                    </div>

                                                </div>

                                                <div>
                                                    <label for="about" class="block text-sm font-medium text-gray-700">
                                                        หน่วยงาน
                                                    </label>
                                                    <div class="mt-1">
                                                        <input type="text" name="department" id="department"
                                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                                            value="{{$user->department ?? ''}}">
                                                    </div>

                                                </div>

                                                <div>
                                                    <label for="about" class="block text-sm font-medium text-gray-700">
                                                        เบอร์โทรศัพท์ที่ติดต่อได้
                                                    </label>
                                                    <div class="mt-1">
                                                        <input type="text" name="tel" id="tel"
                                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                                            value="{{$user->tel ?? ''}}">
                                                    </div>

                                                </div>

                                                <div>
                                                    <label for="about" class="block text-sm font-medium text-gray-700">
                                                        ประเภทผู้ใช้งาน
                                                    </label>
                                                    <div class="mt-1">
                                                        <select name="type" id="type"
                                                            class="form-select rounded-md shadow-sm mt-1 block w-full"
                                                            required>
                                                            <option value="" {{ $user->type === "" ? "selected" : "" }}>
                                                                --กรุณาเลือก--</option>
                                                            <option value="admin"
                                                                {{ $user->type === "admin" ? "selected" : "" }}>
                                                                ผู้ดูแลระบบ</option>
                                                            <option value="officer"
                                                                {{ $user->type === "officer" ? "selected" : "" }}>
                                                                เจ้าหน้าที่กองป้องกันการบาดเจ็บ
                                                            </option>
                                                            <option value="police"
                                                                {{ $user->type === "police" ? "selected" : "" }}>ตำรวจ
                                                            </option>
                                                            <option value="eclaim"
                                                                {{ $user->type === "eclaim" ? "selected" : "" }}>
                                                                บริษัทกลางคุ้มครองผู้ประสบภัยจากรถ
                                                            </option>
                                                            <option value="deathcert"
                                                                {{ $user->type === "deathcert" ? "selected" : "" }}>
                                                                กองยุทธศาสตร์และแผนงาน (มรณบัตร)
                                                            </option>
                                                        </select>

                                                    </div>

                                                </div>

                                                <div>
                                                    <label for="about" class="block text-sm font-medium text-gray-700">
                                                        สถานะบัญชี
                                                    </label>
                                                    <div class="mt-1">
                                                        <select name="status" id="status" required
                                                            class="form-select rounded-md shadow-sm mt-1 block w-full">
                                                            <option value="1"
                                                                {{ $user->status === "1" ? "selected" : "" }}>เปิดใช้งาน
                                                            </option>
                                                            <option value="0"
                                                                {{ $user->status === "0" ? "selected" : "" }}>ระงับ
                                                            </option>

                                                        </select>
                                                    </div>

                                                </div>


                                                <div>

                                                    <div class="mt-1">
                                                        <button type="submit"
                                                            onclick="return confirm('Are you sure ?');"
                                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                            บันทึก
                                                        </button>

                                                        <a href="{{ url('users')}}"
                                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">ย้อนกลับ</a>

                                                    </div>

                                                </div>





                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="hidden sm:block" aria-hidden="true">
                            <div class="py-5">
                                <div class="border-t border-gray-200"></div>
                            </div>
                        </div>

                        <div class="mt-10 sm:mt-0">
                            <div class="md:grid md:grid-cols-3 md:gap-6">
                                <div class="md:col-span-1">
                                    <div class="px-4 sm:px-0">
                                        <h3 class="text-lg font-medium leading-6 text-gray-900">Reset password
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-600">
                                            รีเซ็ตรหัสผ่าน (ผู้ดูแลระบบเท่านั้น)
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-5 md:mt-0 md:col-span-2">

                                    <a href="{{url('resetpw/'.$user->id)}}"
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Reset</a>

                                    <p class="mt-2 text-sm text-gray-500">
                                        หลังจาก Reset รหัสผ่านจะถูกเปลี่ยนเป็นเบอร์โทรศัพท์ที่ลงทะเบียนไว้
                                    </p>
                                </div>
                            </div>
                        </div>




                    </div>
                    <!--/Card-->
                </div>


            </div>
        </div>


    </div>


</x-app-layout>