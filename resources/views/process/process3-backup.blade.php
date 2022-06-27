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

        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 320px;
            max-width: 700px;
            margin: 1em auto;
        }

        .highcharts-data-table table {

            border-collapse: collapse;
            border: 1px solid #EBEBEB;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
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
        <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white  @if (!empty($_GET['direct']))
        hidden
        @endif ">

            <div class="w-full py-6">
                <div class="flex">
                    <div class="w-1/4">
                        <div class="relative mb-2">
                            <div
                                class="w-10 h-10 mx-auto bg-green-500 rounded-full text-lg text-white flex items-center">
                                <span class="text-center text-white w-full">
                                    <svg class="w-full fill-current" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg">
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

                                    <svg class="w-full" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            fill="white"
                                            d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z">
                                        </path>
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <div class="text-xs text-center md:text-base">ประมวลผลตาม Protocol</div>
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
                                    <svg class="w-full " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path class="heroicon-ui" fill="#FFF"
                                            d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-2.3-8.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z" />
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <div class="text-xs text-center md:text-base">ตรวจสอบผล ก่อนกดยืนยันขั้นแรก</div>
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
                                    <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path class="heroicon-ui"
                                            d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-2.3-8.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z" />
                                    </svg>


                                </span>
                            </div>
                        </div>

                        <div class="text-xs text-center md:text-base">ยืนยันขั้นที่ 2 เพื่อเผยแพร่</div>
                    </div>
                </div>
            </div>
        </div>
        <!--/Card-->


        <form name="frm_process1" method="get" action="{{ url('process4',$master_id) }}">
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
                            ข้อมูลการบูรณาการ
                        </h4>

                        <script src="https://code.highcharts.com/highcharts.js"></script>
                        <script src="https://code.highcharts.com/modules/venn.js"></script>
                        <script src="https://code.highcharts.com/modules/exporting.js"></script>
                        <script src="https://code.highcharts.com/modules/accessibility.js"></script>


                        <figure class="highcharts-figure">

                            <div id="container">
                            </div>
                            <h1 class="text-center " style="font-size : 22px;">
                                ยอดรวมทั้งหมด : {{ number_format(17831) ?? '' }} ราย
                            </h1>
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
  //   
    series: [{
        type: 'venn',
        name: '',
        data: [{
            sets: ['Deathcert'],
            value: 2,
            name: 'Deathcert<br>{{ number_format(5206) ?? '' }}'
        }, {
            sets: ['E-claim'],
            value: 2,
            name: 'E-claim<br>{{ number_format(1322) ?? '' }}'
        }, {
            sets: ['Police'],
            value: 2,
            name: 'Police<br>{{ number_format(688) ?? '' }}'
        }, {
            sets: ['Deathcert', 'E-claim'],
            value: 1,
            name: '{{ number_format(5283) ?? '' }}'
        }, {
            sets: ['Deathcert', 'Police'],
            value: 1,
            name: '{{ number_format(2934) ?? '' }}'
        }, {
            sets: ['E-claim', 'Police'],
            value: 1,
            name: '{{ number_format(305) ?? '' }}'
        }, {
            sets: ['E-claim', 'Police', 'Deathcert'],
            value: 1,
            name: '{{ number_format(2093) ?? '' }}'
        }]
    }],
    title: {
        text: 'Report Seven Segments'
    }
});

                        </script>



                        <div class="editor mx-auto w-10/12 flex flex-col text-gray-800  p-4 shadow-lg max-w-2xl">
                            <table class="w-full border">
                                <thead>
                                    <tr class="bg-gray-50 border-b">
                                        <th class="p-2 border-r cursor-pointer text-sm font-thin text-black-500">
                                            ฐานข้อมูล</th>
                                        <th class="p-2 border-r cursor-pointer text-sm font-thin text-black-500">
                                            จำนวน</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="  border-b text-sm text-black-600">
                                        <td class="p-2 border-r">
                                            Deathcert : มรณบัตร
                                        </td>
                                        <td class="p-2 border-r">
                                            {{ number_format($master->deathcert_amount) ?? '' }}
                                        </td>


                                    </tr>

                                    <tr class="  border-b text-sm text-black-600">
                                        <td class="p-2 border-r">
                                            Police : ตำรวจ
                                        </td>
                                        <td class="p-2 border-r">
                                            {{ number_format($master->police_amount) ?? '' }}
                                        </td>


                                    </tr>

                                    <tr class="  border-b text-sm text-black-600">
                                        <td class="p-2 border-r">
                                            E-claim : บ.กลาง ฯ
                                        </td>
                                        <td class="p-2 border-r">
                                            {{ number_format($master->eclaim_amount) ?? '' }}
                                        </td>


                                    </tr>
                                </tbody>
                            </table>

                            <div class="mt-3"></div>

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
                                            {{ $master->user->name ?? '' }} [{{ $master->user->department ?? ''}}]
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
                                            @if ($master->status=='0')
                                            <div
                                                class="py-3 px-2 my-2 bg-gray-300 text-gray-800 rounded border border-gray-600">
                                                ประมวลผลไม่สำเร็จ</div>

                                            @elseif ($master->status=='1')
                                            <div
                                                class="py-3 px-2 my-2 bg-blue-300 text-blue-800 rounded border border-blue-600">
                                                ประมวลผลสำเร็จ ยังไม่ได้รับการเผยแพร่</div>


                                            @elseif ($master->status=='2')
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

                <button id="button" type="submit" onclick="return confirm('ยืนยันผลขั้นที่ 2 ?');"
                    class="w-full px-6 py-3 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-pink-500 hover:bg-pink-600 hover:shadow-lg focus:outline-none">
                    ยืนยันผล เพื่อเผยแพร่
                </button>

                @endif

                <div class="mt-8"></div>
                {{-- ข้อมูลรายการ --}}
                <div class="relative h-16 w-100">
                    <h4 class="text-gray-700 text-3xl font-medium">ข้อมูลดิบหลังการบูรณาการ</h4>
                    <div class="absolute top-0 right-0 h-16 w-100 ">

                        <a href="{{ url('process/exportprocess/'.$master->id) }}">

                            <button
                                class="bg-grey-light hover:bg-blue text-blue-darkest font-bold py-2 px-4 rounded inline-flex items-center  rounded-full border border-blue-600 text-blue-600 ">
                                <svg class="w-4 h-4 mr-2 text-blue-600" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" /></svg>
                                <span>Download Excel file</span>
                            </button>
                        </a>
                    </div>
                </div>
                <!--Card-->


                <div class="flex flex-col ">
                    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">


                        {{ $data->links() }}

                        <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">

                            <table id="example" class="display2 stripe hover min-w-full"
                                style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            เลขบัตรประชาชน</th>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            ชื่อ</th>


                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            สกุล</th>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            เพศ</th>

                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            วันเกิด</th>

                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            วันที่เสียชีวิต
                                        </th>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            จังหวัด
                                        </th>

                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            อายุ(ปี)
                                        </th>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            อายุ(เดือน)
                                        </th>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            อายุ(วัน)
                                        </th>


                                    </tr>
                                </thead>

                                <tbody class="bg-white">

                                    @forelse ($data as $row)
                                    <tr>


                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">

                                            <div class="text-sm leading-5 text-gray-900">
                                                {{ $row->cid ?? '' }}</div>
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-900">
                                            {{ $row->firstname ?? '' }}

                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-900">
                                            {{ $row->lastname ?? '' }}

                                        </td>

                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-900">


                                            @if ($row->gender=='1')
                                            ชาย
                                            @elseif ($row->gender=='2')
                                            หญิง
                                            @else
                                            ไม่ระบุ
                                            @endif

                                        </td>

                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">

                                            {{ $row['birthdate'] != "" ? Carbon\Carbon::parse($row['birthdate'])->addYear(543)->format('d/m/Y') : "" }}


                                        </td>

                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-900">
                                            {{ $row['deathdate'] != "" ? Carbon\Carbon::parse($row['deathdate'])->addYear(543)->format('d/m/Y') : "" }}

                                        </td>

                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-900">
                                            {{ $row->province->name_th ?? '' }}

                                        </td>

                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-900">
                                            {{ $row->age ?? '' }}

                                        </td>

                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-900">
                                            {{ $row->age_m ?? '' }}

                                        </td>

                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-900">
                                            {{ $row->age_d ?? '' }}

                                        </td>


                                    </tr>


                                    @empty

                                    @endforelse
                                </tbody>

                            </table>


                        </div>
                        <!--/Card-->


                    </div>
                </div>


                <div class="mt-8"></div>

                <button id="button" type="submit" onclick="return confirm('ยืนยันผลขั้นที่ 2 ?');"
                    class="w-full px-6 py-3 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-pink-500 hover:bg-pink-600 hover:shadow-lg focus:outline-none">
                    ยืนยันผล เพื่อเผยแพร่
                </button>
        </form>


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