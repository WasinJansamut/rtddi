@section('title','จัดการข้อมูล')
@section('subtitle',Request::path() )
<x-app-layout>
    <!--Regular Datatables CSS-->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <!--Responsive Extension Datatables CSS-->
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">

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
        <h3 class="text-gray-700 text-3xl font-medium">จัดการข้อมูล</h3>

        <div class="mt-4">
            <div class="flex flex-wrap -mx-6">


                <div
                    class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0 transition  ease-in-out transform hover:-translate-y-1 hover:scale-110">
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                        <div class="p-3 rounded-full bg-green-600 bg-opacity-90">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                                </path>
                            </svg>
                        </div>
                        <a href="{{ route('policestation.create') }}">
                            <div class="mx-5">
                                <h4 class="text-2xl font-semibold text-gray-700 ">เพิ่มสถานีตำรวจใหม่</h4>
                                <div class="text-gray-500">Add New Pol_Station</div>
                            </div>
                        </a>
                    </div>
                </div>


                <div
                    class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0 transition  ease-in-out transform hover:-translate-y-1 hover:scale-110">
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                        <div class="p-3 rounded-full bg-indigo-600 bg-opacity-75">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>

                        </div>

                        <div class="mx-5">
                            <h4 class="text-2xl font-semibold text-gray-700">{{ $police_stations_Count ?? 0 }}</h4>
                            <div class="text-gray-500">สถานีทั้งหมด</div>
                        </div>
                    </div>
                </div>

                <div
                    class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0 transition  ease-in-out transform hover:-translate-y-1 hover:scale-110">
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                        <div class="p-3 rounded-full bg-yellow-500 bg-opacity-100">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                </path>
                            </svg>
                        </div>

                        <div class="mx-5">
                            <h4 class="text-2xl font-semibold text-gray-700">
                                <form action="{{ route('policestation.index') }}" method="GET" role="search">
                                    @csrf

                                    <div class="form-group">
                                        <input type="text" class="form-control mr-2" name="term"
                                            placeholder="รหัส , ชื่อ , จังหวัด" id="term" value="{{ $word ?? ''}}">
                                        <button
                                            class="h-8 px-4 text-sm bg-blue-500 hover:bg-blue-700 text-white    rounded">
                                            ค้นหา
                                        </button>
                                    </div>

                                </form>
                            </h4>

                        </div>
                    </div>
                </div>




            </div>
        </div>

        <div class="mt-8">

        </div>

        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">

                    @if ($message = Session::get('success'))
                    <div class="px-4 py-3 leading-normal text-green-700 bg-green-100 rounded-lg" role="alert">
                        <p>{{ $message }}</p>
                    </div>
                    @endif

                    @if ($message = Session::get('error'))
                    <div class="px-4 py-3 leading-normal text-white-700 bg-red-100 rounded-lg" role="alert">
                        <p>{{ $message }}</p>
                    </div>
                    @endif


                    <!--Card-->
                    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">

                        <div class="pull-right tableTools-container"></div>
                        {!! $police_stations->appends(['term' => $word])->links() !!}
                        <table id="example-no" class="stripe hover min-w-full"
                            style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        รหัส</th>
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        ชื่อสถานี</th>
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        รหัสจังหวัด</th>

                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        จังหวัด</th>

                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    </th>

                                </tr>
                            </thead>

                            <tbody class="bg-white">

                                @forelse ($police_stations as $row)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="flex items-center">


                                            <div class="ml-4">
                                                <div class="text-sm leading-5 font-medium text-gray-900">
                                                    {{ $row->ORG_CODE  ?? '-'}}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">{{ $row->ORG  ?? '-'}}</div>

                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">

                                        <div class="text-sm leading-5 text-gray-900">{{ $row->PROV_CODE  ?? '-'}}</div>

                                    </td>

                                    <td
                                        class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                                        <div class="text-sm leading-5 text-gray-900">{{ $row->PROV_NAME  ?? '-'}}</div>
                                    </td>

                                    <td
                                        class="px-6 py-4 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium">



                                        <form action="{{ route('policestation.destroy', $row->ORG_CODE) }}"
                                            method="POST">



                                            <a href="{{ route('policestation.edit', $row->ORG_CODE) }}"
                                                class="text-indigo-600 hover:text-indigo-900">
                                                <i class="fas fa-edit  fa-lg"></i> แก้ไข
                                            </a>

                                            |
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" title="delete"
                                                style="border: none; background-color:transparent;"
                                                onclick="return confirm('การลบข้อมูล จะทำให้ข้อมูลหายไปถาวร หากไม่ต้องการ ให้ใช้การยกเลิกแทน \n ยืนยันการลบข้อมูลหรือไม่?');">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>


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
        </div>


        <!-- jQuery -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

        <!--Datatables -->
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
        <script>
            $(document).ready(function() {
			
			var table = $('#example').DataTable( {
					responsive: true,
                   // "order": [[ 0, "desc" ]]
                   aaSorting: [],

				} )
				.columns.adjust()
				.responsive.recalc();
		} );
    
        $.extend(true, $.fn.dataTable.defaults, {
    "language": {
              "sProcessing": "กำลังดำเนินการ...",
              "sLengthMenu": "แสดง_MENU_ แถว",
              "sZeroRecords": "ไม่พบข้อมูล",
              "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
              "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
              "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
              "sInfoPostFix": "",
              "sSearch": "ค้นหา:",
              "sUrl": "",
              "oPaginate": {
                            "sFirst": "เิริ่มต้น",
                            "sPrevious": "ก่อนหน้า",
                            "sNext": "ถัดไป",
                            "sLast": "สุดท้าย"
              }
     }
});
        </script>



</x-app-layout>