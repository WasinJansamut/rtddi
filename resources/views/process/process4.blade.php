@section('title','ตรวจสอบข้อมูลเพื่อยืนยัน')
@section('subtitle',Request::path() )
<x-app-layout>
    <!--Regular Datatables CSS-->
    {{-- <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    <!--Responsive Extension Datatables CSS-->
    {{--  <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet"> --}}



    <style>
        /*Overrides for Tailwind CSS */

        /*Form fields*/
        .dataTables_wrapper select,
        .dataTables_wrapper .dataTables_filter input {
            color: #4a5568;
            /*text-gray-700*/
            padding-left: 1rem;
            /*pl-4*/
            padding-right: 1rem;
            /*pl-4*/
            padding-top: .5rem;
            /*pl-2*/
            padding-bottom: .5rem;
            /*pl-2*/
            line-height: 1.25;
            /*leading-tight*/
            border-width: 2px;
            /*border-2*/
            border-radius: .25rem;
            border-color: #edf2f7;
            /*border-gray-200*/
            background-color: #edf2f7;
            /*bg-gray-200*/
        }

        /*Row Hover*/
        table.dataTable.hover tbody tr:hover,
        table.dataTable.display tbody tr:hover {
            background-color: #ebf4ff;
            /*bg-indigo-100*/
        }

        /*Pagination Buttons*/
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            font-weight: 700;
            /*font-bold*/
            border-radius: .25rem;
            /*rounded*/
            border: 1px solid transparent;
            /*border border-transparent*/
        }

        /*Pagination Buttons - Current selected */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: #fff !important;
            /*text-white*/
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
            /*shadow*/
            font-weight: 700;
            /*font-bold*/
            border-radius: .25rem;
            /*rounded*/
            background: #667eea !important;
            /*bg-indigo-500*/
            border: 1px solid transparent;
            /*border border-transparent*/
        }

        /*Pagination Buttons - Hover */
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: #fff !important;
            /*text-white*/
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
            /*shadow*/
            font-weight: 700;
            /*font-bold*/
            border-radius: .25rem;
            /*rounded*/
            background: #667eea !important;
            /*bg-indigo-500*/
            border: 1px solid transparent;
            /*border border-transparent*/
        }

        /*Add padding to bottom border */
        table.dataTable.no-footer {
            border-bottom: 1px solid #e2e8f0;
            /*border-b-1 border-gray-300*/
            margin-top: 0.75em;
            margin-bottom: 0.75em;
        }

        /*Change colour of responsive icon*/
        table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before,
        table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
            background-color: #667eea !important;
            /*bg-indigo-500*/
        }
    </style>


    <div class="container mx-auto px-6 py-8">


        {{-- start loadpage --}}
        <div id="hidepage2" style="display:block;" align="center" width="100%">
            <br>
            <IMG SRC="{{ asset('storage/loading.gif') }}" WIDTH="100" HEIGHT="100" BORDER="0" ALT=""><br>
            กรุณารอสักครู่...
        </div>


        {{-- end loadpage --}}

        <!--Card-->
        <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
            <div class="w-full py-6">
                <div class="flex">
                    <div class="w-1/4">
                        <div class="relative mb-2">
                            <div
                                class="w-10 h-10 mx-auto bg-green-500 border-2 border-gray-200 rounded-full text-lg text-white flex items-center">
                                <span class="text-center text-gray-600 w-full">

                                    <svg class="w-full" fill="white" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z">
                                        </path>
                                    </svg>

                                </span>
                            </div>
                        </div>


                        <div class="text-xs text-center md:text-base">เลือกไฟล์ที่ต้องการประมวลผล</div>
                    </div>

                    <div class="w-1/4">
                        <div class="relative mb-2">
                            <div class="absolute flex align-center items-center align-middle content-center"
                                style="width: calc(100% - 2.5rem - 1rem); top: 50%; transform: translate(-50%, -50%)">
                                <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                                    <div class="w-0 bg-green-300 py-1 rounded" style="width: 100%;"></div>
                                </div>
                            </div>

                            <div
                                class="w-10 h-10 mx-auto bg-green-500 border-2 border-gray-200 rounded-full text-lg text-white flex items-center">
                                <span class="text-center text-gray-600 w-full">

                                    <svg class="w-full" fill="white" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4">
                                        </path>
                                    </svg>

                                </span>
                            </div>
                        </div>

                        <div class="text-xs text-center md:text-base">เชื่อมต่อข้อมูล 3 ฐานเข้าด้วยกัน</div>
                    </div>


                    <div class="w-1/4">
                        <div class="relative mb-2">
                            <div class="absolute flex align-center items-center align-middle content-center"
                                style="width: calc(100% - 2.5rem - 1rem); top: 50%; transform: translate(-50%, -50%)">
                                <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                                    <div class="w-0 bg-green-300 py-1 rounded" style="width: 100%;"></div>
                                </div>
                            </div>

                            <div
                                class="w-10 h-10 mx-auto bg-green-500 border-2 border-gray-200 rounded-full text-lg text-white flex items-center">
                                <span class="text-center text-gray-600 w-full">

                                    <svg class="w-full" fill="white" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z">
                                        </path>
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <div class="text-xs text-center md:text-base">ค้นหาตาม Protocol</div>
                    </div>

                    <div class="w-1/4">
                        <div class="relative mb-2">
                            <div class="absolute flex align-center items-center align-middle content-center"
                                style="width: calc(100% - 2.5rem - 1rem); top: 50%; transform: translate(-50%, -50%)">
                                <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                                    <div class="w-0 bg-green-300 py-1 rounded" style="width: 100%;"></div>
                                </div>
                            </div>

                            <div
                                class="w-10 h-10 mx-auto bg-green-500 border-2 border-gray-200 rounded-full text-lg text-white flex items-center">
                                <span class="text-center text-gray-600 w-full">



                                    <svg class="w-full " fill="white" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z">
                                        </path>
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <div class="text-xs text-center md:text-base">ประมวลผล Protocol</div>
                    </div>

                    <div class="w-1/4">
                        <div class="relative mb-2">
                            <div class="absolute flex align-center items-center align-middle content-center"
                                style="width: calc(100% - 2.5rem - 1rem); top: 50%; transform: translate(-50%, -50%)">
                                <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                                    <div class="w-0 bg-green-300 py-1 rounded" style="width: 0%;"></div>
                                </div>
                            </div>

                            <div
                                class="w-10 h-10 mx-auto bg-white-500 border-2 border-gray-200 rounded-full text-lg text-white flex items-center">
                                <span class="text-center text-gray-600 w-full">


                                    <svg class="w-full" fill="white" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                        </path>
                                    </svg>

                                </span>
                            </div>
                        </div>

                        <div class="text-xs text-center md:text-base">สรุปผล ก่อนเผยแพร่</div>
                    </div>

                    <div class="w-1/4">
                        <div class="relative mb-2">
                            <div class="absolute flex align-center items-center align-middle content-center"
                                style="width: calc(100% - 2.5rem - 1rem); top: 50%; transform: translate(-50%, -50%)">
                                <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                                    <div class="w-0 bg-green-300 py-1 rounded" style="width: 0%;"></div>
                                </div>
                            </div>

                            <div
                                class="w-10 h-10 mx-auto bg-white border-2 border-gray-200 rounded-full text-lg text-white flex items-center">
                                <span class="text-center text-gray-600 w-full">
                                    <svg class="w-full" fill="white" stroke="currentColor" viewBox="0 0 24 24">
                                        <path class="heroicon-ui"
                                            d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-2.3-8.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z" />
                                    </svg>


                                </span>
                            </div>
                        </div>

                        <div class="text-xs text-center md:text-base">เผยแพร่ข้อมูลแล้ว</div>
                    </div>

                </div>
            </div>
        </div>
        <!--/Card-->



        <div class="mt-8"></div>


        <div class="flex flex-col ">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">





                <div class="flex flex-col ">
                    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">




                        <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                            @if(!empty($success))
                            <div
                                class="py-3 px-2 my-2 bg-green-300 text-green-800 rounded border border-green-600 text-center">
                                <svg class="w-12 h-12 inline-block	" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>

                                {{ $success }}</div>
                            @endif

                            @if(!empty($error))
                            <div
                                class="py-3 px-2 my-2 bg-red-300 text-white-800 rounded border border-red-600 text-center">
                                <svg class="w-12 h-12 inline-block	" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg> {{ $error }}</div>
                            @endif

                        </div>
                        <!--/Card-->


                        <form name="frm_process1" method="get" action="{{ url('process5',$master_id) }}">
                            @csrf
                            <div class="flex flex-col ">
                                <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">

                                    @if(session()->has('message'))
                                    <div
                                        class="py-3 px-2 my-2 bg-green-300 text-green-800 rounded border border-green-600">
                                        {{session('success')}}</div>
                                    @endif

                                    <button id="button" type="submit" onclick="return confirm('ดูข้อมูลใช่หรือไม่ ?');"
                                        class="w-full px-6 py-3 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-pink-500 hover:bg-pink-600 hover:shadow-lg focus:outline-none">
                                        ถัดไป
                                    </button>

                                </div>
                            </div>
                        </form>


                    </div>
                </div>






                <div id="hidepage" style="display:none;">
                    <audio autoplay id="bgsound">
                        <source src="{{ asset('storage/sound/eventually.mp3') }}" type="audio/mp3">
                        <source src="{{ asset('storage/sound/eventually.ogg') }}" type="audio/ogg; codecs=vorbis">
                        <p>ขออภัย เว็บเบราว์เซอร์ของคุณไม่รองรับเสียงแจ้งเตือน กรุณาเปิดโปรแกรมบน Google Chrome หรือ
                            MS Edge</p>
                    </audio>
                </div>




                <script src="{{ asset('js/vfs_fonts.js') }}"></script>


                <script>
                    function onlyOne1(checkbox) {
    var checkboxes = document.getElementsByName('check_deathcert[]')
    checkboxes.forEach((item) => {
        if (item !== checkbox) item.checked = false
    })
}

function onlyOne2(checkbox) {
    var checkboxes = document.getElementsByName('check_police[]')
    checkboxes.forEach((item) => {
        if (item !== checkbox) item.checked = false
    })
}

function onlyOne3(checkbox) {
    var checkboxes = document.getElementsByName('check_eclaim')
    checkboxes.forEach((item) => {
        if (item !== checkbox) item.checked = false
    })
}
                </script>

</x-app-layout>