@section('title','คู่มือการใช้งาน')
@section('subtitle',Request::path() )
<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">คู่มือการใช้งาน</h3>



        {{-- start loadpage --}}
        <div id="hidepage2" style="display:block;" align="center" width="100%">
            <br>
            <IMG SRC="{{ asset('storage/loading.gif') }}" WIDTH="100" HEIGHT="100" BORDER="0" ALT=""><br>
            กรุณารอสักครู่...
        </div>

        <div id="hidepage" style="display:none;">
        </div>
        {{-- end loadpage --}}




        <div class="mt-4">
            <div class="flex flex-wrap -mx-6">

                <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
                    <a href="{{ asset('storage/manual/user.pdf') }}" target="_blank">
                        <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                            <div class="p-3 rounded-full bg-indigo-400 bg-opacity-75">

                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>

                            <div class="mx-5">
                                <h4 class="text-2xl font-semibold text-gray-700">เอกสารสำหรับเจ้าหน้าที่</h4>
                                <div class="text-gray-500">Manual for operation</div>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
                    <a href="{{ asset('storage/manual/admin.pdf') }}" target="_blank">
                        <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                            <div class="p-3 rounded-full bg-red-400 bg-opacity-75">

                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>

                            <div class="mx-5">
                                <h4 class="text-2xl font-semibold text-gray-700">เอกสารสำหรับผู้ดูแลระบบ</h4>
                                <div class="text-gray-500">Manual for Administrator</div>
                            </div>
                        </div>
                    </a>
                </div>


            </div>
        </div>




        <div class="mt-4">
            <div class="flex flex-wrap -mx-6">
                <div class="w-full px-6 sm:w-1/2 xl:w-1/3 mt-4">
                    <h1 class="font-bold text-xl text-center">การ Import ไฟล์มรณบัตร</h1>
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                        <video width="100%" controls>
                            <source src="{{ asset('storage/vdo/import-deathcert.mp4') }}" type="video/mp4">
                            Your browser does not support HTML video.
                        </video>

                    </div>
                </div>


                <div class="w-full px-6 sm:w-1/2 xl:w-1/3 mt-4">
                    <h1 class="font-bold text-xl text-center">การ Import ไฟล์ตำรวจ</h1>
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                        <video width="100%" controls>
                            <source src="{{ asset('storage/vdo/import-police.mp4') }}" type="video/mp4">
                            Your browser does not support HTML video.
                        </video>

                    </div>
                </div>

                <div class="w-full px-6 sm:w-1/2 xl:w-1/3 mt-4">
                    <h1 class="font-bold text-xl text-center">การ Import ไฟล์บริษัทกลางฯ</h1>
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                        <video width="100%" controls>
                            <source src="{{ asset('storage/vdo/import-eclaim.mp4') }}" type="video/mp4">
                            Your browser does not support HTML video.
                        </video>

                    </div>
                </div>


            </div>
        </div>

        <div class="mt-8">

        </div>




        <div class="mt-4">

            <div class="flex flex-wrap -mx-6">
                <div class="w-full px-6 sm:w-1/2 xl:w-1/3 mt-4">
                    <h1 class="font-bold text-xl text-center">การตรวจสอบข้อมูลก่อนบูรณาการ</h1>
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                        <video width="100%" controls>
                            <source src="{{ asset('storage/vdo/checkdata.mp4') }}" type="video/mp4">
                            Your browser does not support HTML video.
                        </video>

                    </div>
                </div>


                <div class="w-full px-6 sm:w-1/2 xl:w-1/3 mt-4">
                    <h1 class="font-bold text-xl text-center">การบูรณาการข้อมูล</h1>
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                        <video width="100%" controls>
                            <source src="{{ asset('storage/vdo/process.mp4') }}" type="video/mp4">
                            Your browser does not support HTML video.
                        </video>

                    </div>
                </div>



            </div>
        </div>


        <hr>






        <div class="mt-8">
            <h3 class="text-gray-700 text-3xl font-medium">การตั้งค่าอื่นๆ</h3>
            <div class="flex flex-wrap -mx-6">
                <div class="w-full px-6 sm:w-1/2 xl:w-1/3 mt-4">
                    <h1 class="font-bold text-xl text-center">ผู้ใช้งาน</h1>
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                        <video width="100%" controls>
                            <source src="{{ asset('storage/vdo/user.mp4') }}" type="video/mp4">
                            Your browser does not support HTML video.
                        </video>

                    </div>
                </div>


                {{--   <div class="w-full px-6 sm:w-1/2 xl:w-1/3 mt-4">
                    <h1 class="font-bold text-xl text-center">ข้อมูลสถานีตำรวจ</h1>
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                        <video width="100%" controls>
                            <source src="{{ asset('storage/vdo/checkdata.mp4') }}" type="video/mp4">
                Your browser does not support HTML video.
                </video>

            </div>
        </div> --}}


        {{--   <div class="w-full px-6 sm:w-1/2 xl:w-1/3 mt-4">
                    <h1 class="font-bold text-xl text-center">จำนวนประชากร</h1>
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                        <video width="100%" controls>
                            <source src="{{ asset('storage/vdo/checkdata.mp4') }}" type="video/mp4">
        Your browser does not support HTML video.
        </video>

    </div>
    </div> --}}

    <div class="w-full px-6 sm:w-1/2 xl:w-1/3 mt-4">
        <h1 class="font-bold text-xl text-center">ข้อมูลเทศกาล</h1>
        <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
            <video width="100%" controls>
                <source src="{{ asset('storage/vdo/festival.mp4') }}" type="video/mp4">
                Your browser does not support HTML video.
            </video>

        </div>
    </div>

    {{--       <div class="w-full px-6 sm:w-1/2 xl:w-1/3 mt-4">
                    <h1 class="font-bold text-xl text-center">ข้อมูลอัตราการเสียชีวิต(เกณฑ์)</h1>
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                        <video width="100%" controls>
                            <source src="{{ asset('storage/vdo/checkdata.mp4') }}" type="video/mp4">
    Your browser does not support HTML video.
    </video>

    </div>
    </div>
    --}}


    </div>
    </div>















    </div>

</x-app-layout>