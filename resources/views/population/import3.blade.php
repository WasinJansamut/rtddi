@section('title','Import2')
@section('subtitle',Request::path() )
<x-app-layout>

    <style>
        input.text {
            focus: ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300
        }
    </style>
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">ตรวจเช็คข้อมูลนำเข้า</h3>

        {{-- start loadpage --}}
        <div id="hidepage2" style="display:block;" align="center" width="100%">
            <br>
            <IMG SRC="{{ asset('storage/loading.gif') }}" WIDTH="100" HEIGHT="100" BORDER="0" ALT=""><br>
            กรุณารอสักครู่...
        </div>

        <div id="hidepage" style="display:none;">
        </div>
        {{-- end loadpage --}}


        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">





                    <!--Card-->
                    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">


                        <div>
                            <div class="flex">
                                <div class="w-1/3 text-center px-6">
                                    <div
                                        class="bg-gray-300 rounded-lg flex items-center justify-center border border-gray-200">
                                        <div
                                            class="w-1/3 bg-transparent h-20 flex items-center justify-center icon-step">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                                </path>
                                            </svg>
                                        </div>
                                        <div
                                            class="w-2/3 bg-gray-200 h-24 flex flex-col items-center justify-center px-1 rounded-r-lg body-step">
                                            <h2 class="font-bold text-lg">1. อัพโหลด</h2>
                                            <p class="text-xs text-gray-600">
                                                อัพโหลดไฟล์ Excle หรือ CSV ตามที่กำหนด
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-1 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path d="M14 2h-7.229l7.014 7h-13.785v6h13.785l-7.014 7h7.229l10-10z" />
                                    </svg>
                                </div>
                                <div class="w-1/3 text-center px-6">
                                    <div
                                        class="bg-gray-300 rounded-lg flex items-center justify-center border border-gray-200">
                                        <div
                                            class="w-1/3 bg-transparent h-20 flex items-center justify-center icon-step">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                                </path>
                                            </svg>
                                        </div>
                                        <div
                                            class="w-2/3 bg-gray-200 h-24 flex flex-col items-center justify-center px-1 rounded-r-lg body-step">
                                            <h2 class="font-bold text-lg">2. เช็คข้อมูล</h2>
                                            <p class="text-xs text-gray-600">
                                                เช็คข้อมูลว่าถูกต้องหรือไม่ หากถูกต้องให้กดบันทึก
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-1 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path d="M14 2h-7.229l7.014 7h-13.785v6h13.785l-7.014 7h7.229l10-10z" />
                                    </svg>
                                </div>
                                <div class="w-1/3 text-center px-6">
                                    <div
                                        class="bg-green-300 rounded-lg flex items-center justify-center border border-gray-200">
                                        <div
                                            class="w-1/3 bg-transparent h-20 flex items-center justify-center icon-step">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3">
                                                </path>
                                            </svg>
                                        </div>
                                        <div
                                            class="w-2/3 bg-green-200 h-24 flex flex-col items-center justify-center px-1 rounded-r-lg body-step">
                                            <h2 class="font-bold text-lg">3. เสร็จสิ้น</h2>
                                            <p class="text-xs text-gray-600">
                                                แสดงจำนวนข้อมูลที่ถูกนำเข้า
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>







                    </div>
                    <!--/Card-->

                    <br>

                    <!--Card-->
                    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">




                        <div class="p-2 text-center">
                            <div
                                class="inline-flex items-center bg-white leading-none text-purple-600 rounded-full p-2 shadow text-teal text-sm">

                                @if(!empty($message))


                                <span class="inline-flex px-2">{{ $message }}</span>
                                @endif
                            </div>
                            <span
                                class="inline-flex bg-indigo-600 text-white rounded-full h-6 px-3 justify-center items-center">
                                <a href="{{url('population')}}">
                                    << กลับสู่หน้าจำนวนประชากร</a> </span> </div> </div> <!--/Card--> </div> </div>
                                        </div> </div> </x-app-layout>