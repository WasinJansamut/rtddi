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
        {{--    <div id="hidepage2" style="display:block;" align="center" width="100%">
            <br>
            <IMG SRC="{{ asset('storage/loading.gif') }}" WIDTH="100" HEIGHT="100" BORDER="0" ALT=""><br>
        กรุณารอสักครู่...
    </div> --}}


    {{-- end loadpage --}}

    <!--Card-->
    @php
    $dead_y_th = (int)$master->year_dead+543 ;
    @endphp
    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white  @if (!empty($_GET['direct']))
     hidden
     @endif ">
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
                                <div class="w-0 bg-green-300 py-1 rounded" style="width: 100%;"></div>
                            </div>
                        </div>

                        <div
                            class="w-10 h-10 mx-auto bg-green-500 border-2 border-gray-200 rounded-full text-lg text-white flex items-center">
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
                                <div class="w-0 bg-green-300 py-1 rounded" @if ($master->status=='5')
                                    style="width: 100%;"
                                    @endif></div>
                            </div>
                        </div>

                        <div class="w-10 h-10 mx-auto @if ($master->status=='5')
                                bg-green-500
                                @else   bg-white
                                @endif border-2 border-gray-200 rounded-full text-lg text-white flex items-center">
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
                            <svg class="w-12 h-12 inline-block	" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>

                            {{ $success }}</div>
                        @endif

                        @if(!empty($error))
                        <div class="py-3 px-2 my-2 bg-red-300 text-white-800 rounded border border-red-600 text-center">
                            <svg class="w-12 h-12 inline-block	" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg> {{ $error }}</div>
                        @endif

                    </div>
                    <!--/Card-->


                    <form name="frm_process1" method="get" action="{{ url('process6',$master_id) }}">
                        @csrf
                        <div class="flex flex-col ">
                            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">

                                @if(session('success'))<div
                                    class="py-3 px-2 my-2 bg-green-300 text-green-800 rounded border border-green-600">
                                    {{session('success')}}</div>
                                @endif

                                @if(session('error'))<div
                                    class="py-3 px-2 my-2 bg-red-300 text-white-800 rounded border border-red-600">
                                    {{session('error')}}</div>
                                @endif


                                {{--  deathcert --}}
                                <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                                    <h4 class="text-gray-700 text-3xl font-medium">
                                        ข้อมูลการบูรณาการ ปี {{ $master->year_dead+543 ?? '' }}
                                    </h4>

                                    <div
                                        class="editor mx-auto w-10/12 flex flex-col text-gray-800  p-4 shadow-lg max-w-2xl">

                                        <div class="flex items-center text-center">
                                            <hr class="border-gray-300 border-1 w-full rounded-md">
                                            <label class="block  w-full">
                                                <h3>ข้อมูลตั้งต้น</h3>
                                            </label>
                                            <hr class="border-gray-300 border-1 w-full rounded-md">
                                        </div>
                                        <table class="w-full border">
                                            <thead>
                                                <tr class="bg-gray-50 border-b ">
                                                    <th class="p-2 border-r cursor-pointer text-sm   text-black-600 ">
                                                        ฐานข้อมูล</th>

                                                    <th class="p-2 border-r cursor-pointer text-sm  text-black-600">
                                                        จำนวน</th>
                                                    <th class="p-2 border-r cursor-pointer text-sm  text-black-600">
                                                        ดูข้อมูล</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="  border-b text-sm text-black-600">
                                                    <td class="p-2 border-r">
                                                        Deathcert : มรณบัตร
                                                    </td>
                                                    <td class="p-2 border-r text-right">
                                                        {{ number_format($master->deathcert_amount) ?? '' }}

                                                    </td>
                                                    <td class="p-2 border-r">
                                                        <div class="flex item-center justify-center">
                                                            <a href="{{url('datadeathcert',$master->deathcert_file_id)}}"
                                                                target="_blank">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" width="24" height="24"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                                </svg></a> </div>
                                                    </td>

                                                </tr>



                                                <tr class="  border-b text-sm text-black-600">
                                                    <td class="p-2 border-r">
                                                        E-claim : บ.กลาง ฯ
                                                    </td>
                                                    <td class="p-2 border-r text-right">
                                                        {{ number_format($master->eclaim_amount) ?? '' }}
                                                    </td>
                                                    <td class="p-2 border-r text-center">
                                                        <div class="flex item-center justify-center">
                                                            <a href="{{url('dataeclaim',$master->eclaim_file_id)}}"
                                                                target="_blank">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" width="24" height="24"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                                </svg></a></div>
                                                    </td>
                                                </tr>

                                                <tr class="  border-b text-sm text-black-600">
                                                    <td class="p-2 border-r">
                                                        Police : ตำรวจ
                                                    </td>
                                                    <td class="p-2 border-r text-right">
                                                        {{ number_format($master->police_amount) ?? '' }}

                                                    </td>

                                                    <td class="p-2 border-r">
                                                        <div class="flex item-center justify-center">
                                                            <a href="{{url('datapolice',$master->police_file_id)}}"
                                                                target="_blank">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" width="24" height="24"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                                </svg></a></div>
                                                    </td>


                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                    <script src="https://code.highcharts.com/highcharts.js"></script>
                                    <script src="https://code.highcharts.com/modules/venn.js"></script>
                                    <script src="https://code.highcharts.com/modules/exporting.js"></script>
                                    <script src="https://code.highcharts.com/modules/accessibility.js"></script>


                                    <figure class="highcharts-figure">

                                        <div id="container">
                                        </div>
                                        <h1 class="text-center " style="font-size : 22px;">
                                            ยอดรวมทั้งหมด : {{ number_format($master->amount_total) ?? '' }} ราย
                                            <br>

                                        </h1>
                                        <h4 class="text-center ">
                                            @if($master->status=='0'||$master->status=='1'||$master->status=='2'||$master->status=='3')

                                            <div
                                                class="py-3 px-2 my-2 bg-gray-300 text-gray-800 rounded border border-gray-600 ">
                                                ประมวลผลไม่สำเร็จ</div>

                                            @elseif ($master->status=='4')
                                            <div
                                                class="py-3 px-2 my-2 bg-blue-300 text-blue-800 rounded border border-blue-600">
                                                ประมวลผลสำเร็จ ยังไม่ได้รับการเผยแพร่</div>


                                            @elseif ($master->status=='5')
                                            <div
                                                class="py-3 px-2 my-2 bg-green-300 text-green-800 rounded border border-green-600 ">
                                                ประมวลผลสำเร็จ ได้รับการยืนยันเพื่อเผยแพร่ </div>
                                            @else
                                            @endif
                                        </h4>
                                        <h4 class="text-center ">
                                            @if ($master->status=='4')
                                            <a href="{{ url('process/exportprefinal/'.$master->id) }}">
                                                <button
                                                    class="bg-grey-light hover:bg-blue text-blue-darkest font-bold py-2 px-4 rounded inline-flex items-center  rounded-full border border-blue-600 text-blue-600 "
                                                    type="button">
                                                    <svg class="w-4 h-4 mr-2 text-blue-600"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                        <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" /></svg>
                                                    <span>Download XLS (PreFinal)</span>
                                                </button>
                                            </a>
                                            @elseif ($master->status=='5')
                                            <a href="{{ url('process/exportfinal/'.((int)$master->year_dead+543)) }}">

                                                <button
                                                    class="bg-grey-light hover:bg-green text-green-darkest font-bold py-2 px-4 rounded inline-flex items-center  rounded-full border border-green-600 text-green-600 "
                                                    type="button">
                                                    <svg class="w-4 h-4 mr-2 text-blue-600"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                        <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" /></svg>
                                                    <span>Download XLS (Final) ปี
                                                        {{ (int)$master->year_dead+543 }}</span>
                                                </button>
                                            </a>
                                            @endif

                                            <a href="{{ asset('storage/RTDDI data dictionary.xlsx') }}">

                                                <button
                                                    class="bg-grey-light hover:bg-blue text-blue-darkest font-bold py-2 px-4 rounded inline-flex items-center  rounded-full border border-blue-600 text-blue-600 "
                                                    type="button">
                                                    <svg class="w-4 h-4 mr-2 text-blue-600"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                        <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" /></svg>
                                                    <span>data dictionary</span>
                                                </button>
                                            </a>

                                        </h4>
                                    </figure>


                                    <script>
                                        Highcharts.chart('container', {
                                tooltip: {
            formatter: function() {
                    return false; // now you don't
            }
        },
    accessibility: {
        point: {
            descriptionFormatter: function (point) {
                var intersection = point.sets.join(', '),
                    name = point.name,
                    ix = point.index + 1,
                    val = point.value;
                return ix + '. Intersection: ' + intersection + '. ' +
                    (point.sets.length > 1 ? name + '. ' : '') + 'Value ' + val + '.';
            }
        }
    },
    series: [{
        cursor: 'pointer',
        point: {
                    events: {
                        click: function () {
                            location.href = this.options.url;
                        }
                    }
                },
        type: 'venn',
        name: '',

@if($master->status=='4')
data: [{
            sets: ['Deathcert'],
            value: 2,
            url: '{{ url('exportprotocolprefinal/'.$master->id.'/7')}}',
            name: 'Deathcert<br>{{ number_format($c_d) ?? '' }}'
        }, {
            sets: ['E-claim'],
            value: 2,
            url: '{{ url('exportprotocolprefinal/'.$master->id.'/5')}}',
            name: 'E-claim<br>{{ number_format($c_e) ?? '' }}'
        }, {
            sets: ['Police'],
            value: 2,
            url: '{{ url('exportprotocolprefinal/'.$master->id.'/6')}}',
            name: 'Police<br>{{ number_format($c_p) ?? '' }}'
        }, {
            sets: ['Deathcert', 'E-claim'],
            value: 1,
            url: '{{ url('exportprotocolprefinal/'.$master->id.'/2')}}',
            name: '{{ number_format($c_de) ?? '' }}'
        }, {
            sets: ['Deathcert', 'Police'],
            value: 1,
            url: '{{ url('exportprotocolprefinal/'.$master->id.'/3')}}',
            name: '{{ number_format($c_dp) ?? '' }}'
        }, {
            sets: ['E-claim', 'Police'],
            value: 1,
            url: '{{ url('exportprotocolprefinal/'.$master->id.'/4')}}',
            name: '{{ number_format($c_pe) ?? '' }}'
        }, {
            sets: ['E-claim', 'Police', 'Deathcert'],
            value: 1,
            url: '{{ url('exportprotocolprefinal/'.$master->id.'/1')}}',
            name: '{{ number_format($c_all) ?? '' }}'
        }]
    }],
    title: {
        text: 'Report Seven Segments  : ปี {{ $master->year_dead+543 ?? '' }}'
    },
    responsive: {
        rules: [{
            condition: {
                maxWidth: 650
            },
            chartOptions: {
                plotOptions: {
                    venn: {
                        dataLabels: {
                            style: {
                                fontSize: '18px',

                            }
                        }
                    }
                }
            }
        }]
    }
});
@elseif ($master->status=='5')

        data: [{
            sets: ['Deathcert'],
            value: 2,
            url: '{{ url('exportprotocolfinal/'.$dead_y_th.'/7')}}',
            name: 'Deathcert<br>{{ number_format($c_d) ?? '' }}'
        }, {
            sets: ['E-claim'],
            value: 2,
            url: '{{ url('exportprotocolfinal/'.$dead_y_th.'/5')}}',
            name: 'E-claim<br>{{ number_format($c_e) ?? '' }}'
        }, {
            sets: ['Police'],
            value: 2,
            url: '{{ url('exportprotocolfinal/'.$dead_y_th.'/6')}}',
            name: 'Police<br>{{ number_format($c_p) ?? '' }}'
        }, {
            sets: ['Deathcert', 'E-claim'],
            value: 1,
            url: '{{ url('exportprotocolfinal/'.$dead_y_th.'/2')}}',
            name: '{{ number_format($c_de) ?? '' }}'
        }, {
            sets: ['Deathcert', 'Police'],
            value: 1,
            url: '{{ url('exportprotocolfinal/'.$dead_y_th.'/3')}}',
            name: '{{ number_format($c_dp) ?? '' }}'
        }, {
            sets: ['E-claim', 'Police'],
            value: 1,
            url: '{{ url('exportprotocolfinal/'.$dead_y_th.'/4')}}',
            name: '{{ number_format($c_pe) ?? '' }}'
        }, {
            sets: ['E-claim', 'Police', 'Deathcert'],
            value: 1,
            url: '{{ url('exportprotocolfinal/'.$dead_y_th.'/1')}}',
            name: '{{ number_format($c_all) ?? '' }}'
        }]
    }],
    title: {
        text: 'Report Seven Segments'
    },
    responsive: {
        rules: [{
            condition: {
                maxWidth: 650
            },
            chartOptions: {
                plotOptions: {
                    venn: {
                        dataLabels: {
                            style: {
                                fontSize: '18px',

                            }
                        }
                    }
                }
            }
        }]
    }
});
@endif

                                    </script>





                                    <div
                                        class="editor mx-auto w-10/12 flex flex-col text-gray-800  p-4 shadow-lg max-w-2xl">

                                        <div class="mt-3"></div>


                                        <div class="flex items-center text-center">
                                            <hr class="border-gray-300 border-1 w-full rounded-md">
                                            <label class="block  w-full">
                                                <h3>Protocol</h3>
                                            </label>
                                            <hr class="border-gray-300 border-1 w-full rounded-md">
                                        </div>


                                        <table class="w-full border">
                                            <thead>
                                                <tr class="bg-gray-50 border-b ">
                                                    <th class="p-2 border-r cursor-pointer text-sm   text-black-600 ">
                                                        รายการ</th>
                                                    <th class="p-2 border-r cursor-pointer text-sm  text-black-600">
                                                        จำนวน</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="  border-b text-sm text-black-600">
                                                    <td class="p-2 border-r">
                                                        1. Death Cert vs. E-Claim vs. POLIS
                                                    </td>
                                                    <td class="p-2 border-r text-right">
                                                        {{ number_format($c_all) ?? '' }}
                                                    </td>


                                                </tr>

                                                <tr class="  border-b text-sm text-black-600">
                                                    <td class="p-2 border-r">
                                                        2. Death Cert vs. E-Claim
                                                    </td>
                                                    <td class="p-2 border-r text-right">
                                                        {{ number_format($c_de) ?? '' }}
                                                    </td>


                                                </tr>

                                                <tr class="  border-b text-sm text-black-600">
                                                    <td class="p-2 border-r">
                                                        3. Death Cert vs. POLIS

                                                    </td>
                                                    <td class="p-2 border-r text-right">
                                                        {{ number_format($c_dp) ?? '' }}
                                                    </td>
                                                </tr>

                                                <tr class="  border-b text-sm text-black-600">
                                                    <td class="p-2 border-r">
                                                        4. POLIS vs. E-Claim
                                                    </td>
                                                    <td class="p-2 border-r text-right">
                                                        {{ number_format($c_pe) ?? '' }}
                                                    </td>
                                                </tr>


                                                <tr class="  border-b text-sm text-black-600">
                                                    <td class="p-2 border-r">
                                                        5. E-claim
                                                    </td>
                                                    <td class="p-2 border-r text-right">
                                                        {{ number_format($c_e) ?? '' }}
                                                    </td>
                                                </tr>


                                                <tr class="  border-b text-sm text-black-600">
                                                    <td class="p-2 border-r ">
                                                        6. POLIS

                                                    </td>
                                                    <td class="p-2 border-r text-right">
                                                        {{ number_format($c_p) ?? '' }}
                                                    </td>
                                                </tr>

                                                <tr class="  border-b text-sm text-black-600">
                                                    <td class="p-2 border-r">
                                                        6.1 (New) Police per_dead not 3 (ตัดผู้บาดเจ็บจากฐานตำรวจ)
                                                    </td>
                                                    <td class="p-2 border-r text-right">
                                                      -  {{ number_format($master->count_predead3) ?? '' }}
                                                    </td>
                                                </tr>


                                                <tr class="  border-b text-sm text-black-600">
                                                    <td class="p-2 border-r">
                                                        7. Death Cert
                                                    </td>
                                                    <td class="p-2 border-r text-right">
                                                        {{ number_format($c_d) ?? '' }}
                                                    </td>
                                                </tr>

                                                <tr class="  border-b text-sm text-black-600">
                                                    <td class="p-2 border-r">
                                                        7.2 Death Cert Not V (ตัดผู้บาดเจ็บที่ไม่ใช่รหัส V จากฐานมรณบัตร)
                                                    </td>
                                                    <td class="p-2 border-r text-right">
                                                       -  {{ number_format($master->not_v) ?? '' }}
                                                    </td>
                                                </tr>



                                            </tbody>
                                        </table>


                                        <div class="mt-3"></div>


                                        <div class="flex items-center text-center">
                                            <hr class="border-gray-300 border-1 w-full rounded-md">
                                            <label class="block  w-full">
                                                <h3>ข้อมูลการประมวลผล</h3>
                                            </label>
                                            <hr class="border-gray-300 border-1 w-full rounded-md">
                                        </div>

                                        <table class="w-full border">

                                            <tbody>
                                                <tr class="  border-b text-sm text-black-600">
                                                    <th class="p-2 border-r text-left">
                                                        ประมวลผลประจำปี
                                                    </th>
                                                    <td class="p-2 border-r">
                                                        {{ $master->year_dead+543 ?? '' }}
                                                    </td>


                                                </tr>

                                                <tr class="  border-b text-sm text-black-600">
                                                    <th class="p-2 border-r  text-left">
                                                        หมายเหตุ
                                                    </th>
                                                    <td class="p-2 border-r">
                                                        {{ $master->note ?? '' }}
                                                    </td>


                                                </tr>

                                                <tr class="  border-b text-sm text-black-600">
                                                    <th class="p-2 border-r text-left">
                                                        โดย
                                                    </th>
                                                    <td class="p-2 border-r">
                                                        {{ $master->user->name ?? '' }}
                                                        [{{ $master->user->department ?? ''}}]
                                                    </td>
                                                </tr>

                                                <tr class="  border-b text-sm text-black-600">
                                                    <th class="p-2 border-r  text-left">
                                                        เมื่อ
                                                    </th>
                                                    <td class="p-2 border-r">
                                                        {{ Carbon\Carbon::parse($master['created_at'])->addYear(543)->format('d/m/Y H:i:s') }}
                                                    </td>
                                                </tr>


                                                <tr class="  border-b text-sm text-black-600">
                                                    <th class="p-2 border-r  text-left">
                                                        สถานะ
                                                    </th>
                                                    <td class="p-2 border-r">
                                                        @if($master->status=='0'||$master->status=='1'||$master->status=='2'||$master->status=='3')
                                                        <div
                                                            class="py-3 px-2 my-2 bg-gray-300 text-gray-800 rounded border border-gray-600">
                                                            ประมวลผลไม่สำเร็จ</div>

                                                        @elseif ($master->status=='4')
                                                        <div
                                                            class="py-3 px-2 my-2 bg-blue-300 text-blue-800 rounded border border-blue-600">
                                                            ประมวลผลสำเร็จ ยังไม่ได้รับการเผยแพร่</div>


                                                        @elseif ($master->status=='5')
                                                        <div
                                                            class="py-3 px-2 my-2 bg-green-300 text-green-800 rounded border border-green-600">
                                                            ประมวลผลสำเร็จ ได้รับการยืนยันเพื่อเผยแพร่ </div>
                                                        @else
                                                        @endif
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>



                                    </div>
                                    <!--/Card-->


                                </div>
                            </div>




                            @if(in_array(Auth::user()->type, array("admin")))
                            <span class="text-red-800">ในการยืนยันผลครั้งนี้ จะลบข้อมูลการประมวลผลครั้งที่แล้ว
                                แต่ถ้าหากท่านต้องการค่าเดิม ท่านสามารถเลือกการประมวลผลในครั้งที่แล้ว
                                แล้วกดยืนยันข้อมูลใหม่ได้
                            </span>
                            <button id="button" type="submit"
                                onclick="return confirm('ในการยืนยันผลครั้งนี้ จะลบข้อมูลการประมวลผลครั้งที่แล้ว แน่ใจหรือไม่ว่าต้องการประมวลผลปี '(int)$master->year_dead+543' ใหม่ ใช่หรือไม่ ?');"
                                class="w-full px-6 py-3 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-pink-500 hover:bg-pink-600 hover:shadow-lg focus:outline-none">
                                ยืนยันผล เพื่อเผยแพร่ (Admin Only)
                            </button>

                            @endif

                            <div class="mt-8"></div>
                            {{-- ข้อมูลรายการ --}}
                            <div class="relative h-16 w-100">
                                <h4 class="text-gray-700 text-3xl font-medium">ข้อมูลดิบหลังการบูรณาการ</h4>
                                <div class="absolute top-0 right-0 h-16 w-100 ">

                                    {{--    <a href="{{ url('process/export/'.$master->id) }}">

                                    <button
                                        class="bg-grey-light hover:bg-blue text-blue-darkest font-bold py-2 px-4 rounded inline-flex items-center  rounded-full border border-blue-600 text-blue-600 "
                                        type="button">
                                        <svg class="w-4 h-4 mr-2 text-blue-600" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" /></svg>
                                        <span>Download Excel file</span>
                                    </button>
                                    </a> --}}
                                </div>
                            </div>
                            <!--Card-->


                        </div>
                </div>


                {{ $data->links() }}
                <div class="border-gray-200 w-full rounded bg-white overflow-x-auto">
                    <table class="w-full leading-normal ">
                        <thead
                            class="text-gray-600 text-xs font-semibold border-gray tracking-wider text-left px-5 py-3 bg-gray-100 hover:cursor-pointer uppercase border-b-2 border-gray-200">
                            <tr class="border-b border-gray">
                                <th scope="col"
                                    class="text-gray-dark border-gray border-b-2 border-t-2 border-gray-200 py-3 px-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    เลขบัตรประชาชน
                                </th>
                                <th scope="col"
                                    class="text-gray-dark border-gray border-b-2 border-t-2 border-gray-200 py-3 px-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    ชื่อ
                                <th scope="col"
                                    class="text-gray-dark border-gray border-b-2 border-t-2 border-gray-200 py-3 px-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    สกุล
                                </th>
                                <th scope="col"
                                    class="text-gray-dark border-gray border-b-2 border-t-2 border-gray-200 py-3 px-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    เพศ
                                </th>
                                <th scope="col"
                                    class="text-gray-dark border-gray border-b-2 border-t-2 border-gray-200 py-3 px-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    วันเกิด
                                </th>
                                <th scope="col"
                                    class="text-gray-dark border-gray border-b-2 border-t-2 border-gray-200 py-3 px-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    วันที่เสียชีวิต
                                </th>
                                <th scope="col"
                                    class="text-gray-dark border-gray border-b-2 border-t-2 border-gray-200 py-3 px-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    จังหวัด
                                </th>
                                <th scope="col"
                                    class="text-gray-dark border-gray border-b-2 border-t-2 border-gray-200 py-3 px-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    อายุ(ปี)
                                </th>
                                <th scope="col"
                                    class="text-gray-dark border-gray border-b-2 border-t-2 border-gray-200 py-3 px-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    อายุ(เดือน)
                                </th>
                                <th scope="col"
                                    class="text-gray-dark border-gray border-b-2 border-t-2 border-gray-200 py-3 px-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    อายุ(วัน)
                                </th>
                                <th scope="col"
                                    class="text-gray-dark border-gray border-b-2 border-t-2 border-gray-200 py-3 px-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    DEATHCERT
                                </th>
                                <th scope="col"
                                    class="text-gray-dark border-gray border-b-2 border-t-2 border-gray-200 py-3 px-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    E-CLAIM
                                </th>
                                <th scope="col"
                                    class="text-gray-dark border-gray border-b-2 border-t-2 border-gray-200 py-3 px-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    POLICE
                                </th>

                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($data as $row)
                            <tr class="hover:bg-gray-100 hover:cursor-pointer">


                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">

                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ $row->DrvSocNO ?? '' }}</div>
                                </td>
                                <td class="py-4 px-6 border-b border-gray-200 text-gray-900 text-sm ">
                                    {{ $row->Fname ?? '' }}

                                </td>
                                <td class="py-4 px-6 border-b border-gray-200 text-gray-900 text-sm ">
                                    {{ $row->Lname ?? '' }}

                                </td>

                                <td class="py-4 px-6 border-b border-gray-200 text-gray-900 text-sm ">


                                    @if ($row->Sex=='1')
                                    ชาย
                                    @elseif ($row->Sex=='2')
                                    หญิง
                                    @else
                                    ไม่ระบุ
                                    @endif

                                </td>

                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">

                                    {{ $row['BirthDate_en'] != "" ? Carbon\Carbon::parse($row['BirthDate_en'])->addYear(543)->format('d/m/Y') : "" }}


                                </td>

                                <td class="py-4 px-6 border-b border-gray-200 text-gray-900 text-sm ">
                                    {{ $row['DeadDate_en'] != "" ? Carbon\Carbon::parse($row['DeadDate_en'])->addYear(543)->format('d/m/Y') : "" }}

                                </td>

                                <td class="py-4 px-6 border-b border-gray-200 text-gray-900 text-sm ">
                                    {{ $row->province->name_th ?? '' }}

                                </td>

                                <td class="py-4 px-6 border-b border-gray-200 text-gray-900 text-sm ">
                                    {{ $row->Age ?? '' }}

                                </td>

                                <td class="py-4 px-6 border-b border-gray-200 text-gray-900 text-sm ">
                                    {{ $row->Age_m ?? '' }}

                                </td>

                                <td class="py-4 px-6 border-b border-gray-200 text-gray-900 text-sm ">
                                    {{ $row->Age_d ?? '' }}

                                </td>

                                <td class="py-4 px-6 border-b border-gray-200 text-gray-900 text-sm ">
                                    {{ $row->IS_DEATH_CERT ?? '' }}

                                </td>

                                <td class="py-4 px-6 border-b border-gray-200 text-gray-900 text-sm ">
                                    {{ $row->IS_E_CLAIM ?? '' }}

                                </td>

                                <td class="py-4 px-6 border-b border-gray-200 text-gray-900 text-sm ">
                                    {{ $row->IS_POLIS ?? '' }}

                                </td>


                            </tr>


                            @empty

                            @endforelse


                        </tbody>
                    </table>
                </div>

                </form>



            </div>
        </div>





        {{--   <div id="hidepage" style="display:none;">
                    <audio autoplay id="bgsound">
                        <source src="{{ asset('storage/sound/eventually.mp3') }}" type="audio/mp3">
        <source src="{{ asset('storage/sound/eventually.ogg') }}" type="audio/ogg; codecs=vorbis">
        <p>ขออภัย เว็บเบราว์เซอร์ของคุณไม่รองรับเสียงแจ้งเตือน กรุณาเปิดโปรแกรมบน Google Chrome หรือ
            MS Edge</p>
        </audio>
    </div> --}}




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
