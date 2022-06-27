@section('title','ประวัติการบูรณาการข้อมูล')
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

        <div id="hidepage" style="display:none;">
        </div>
        {{-- end loadpage --}}

        <div class="flex flex-col">
            <div class="my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">

                {{--  <div class="mt-8"></div> --}}

                <h4 class="text-gray-700 text-3xl font-medium">การประมวลผล</h4> <span
                    class="text-sm">(ล่าสุดอยู่บน)</span>
                <!--Card-->


                @if(session('success'))<div
                    class="py-3 px-2 my-2 bg-green-300 text-green-800 rounded border border-green-600">
                    {{session('success')}}</div>
                @endif

                <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">

                    <table id="police_history example2" class="display stripe hover min-w-full"
                        style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    วันที่ประมวลผล</th>

                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    ปีที่เสียชีวิต</th>

                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Deathcert</th>

                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    E-Claim</th>

                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Police</th>


                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    จำนวนผู้เสียชีวิต(หลังบูรณาการ)
                                </th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    โดย
                                </th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    หมายเหตุ
                                </th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    สถานะ (0-4)
                                </th>

                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Action</th>



                            </tr>
                        </thead>

                        <tbody class="bg-white">

                            @forelse ($master as $row_master)
                            <tr @if ($row_master->status=='0')
                                style="background-color:#DCDCDC"
                                @endif
                                >
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex items-center">


                                        <div class="ml-4">
                                            <div class="text-sm leading-5 font-medium text-gray-900">

                                                {{ Carbon\Carbon::parse($row_master['created_at'])->addYear(543)->format('d/m/Y H:i:s') }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ $row_master->year_dead+543 ?? '' }} </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ $row_master->deathcert_amount ?? '' }} </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">

                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ $row_master->eclaim_amount ?? '' }} </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">

                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ $row_master->police_amount ?? '' }} </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">

                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ $row_master->amount_total ?? '' }} </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">

                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ $row_master->user->name ?? '' }} [{{$row_master->user->department}}] </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">

                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ $row_master->note ?? '' }} </div>
                                </td>


                                {{--   1 : เชื่อมข้อมูลทุกฐานเป็นข้อมูลเดียวกัน
                                2 : นำข้อมูลมาCrossกันเพื่อหา Protocol
                                3 : สรุป Protocol
                                4 : ประมวลผลสำเร็จ ยังไม่ได้รับการเผยแพร่
                                  5 : ประมวลผลสำเร็จ เผยแพร่แล้ว
                                0 : ประมวลผลไม่สำเร็จ --}}
                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                                    @if ($row_master->status=='1')
                                    <span
                                        class="bg-gray-500 text-white px-4 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black ">
                                        1:ไม่สำเร็จ</span>


                                    @elseif ($row_master->status=='2')
                                    <span
                                        class="bg-gray-500 text-white px-4 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black ">
                                        2:ไม่สำเร็จ</span>
                                    @elseif ($row_master->status=='3')
                                    <span
                                        class="bg-gray-500 text-white px-4 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black ">3:ไม่สำเร็จ</span>
                                    @elseif ($row_master->status=='4')
                                    <span
                                        class="bg-green-500 text-white px-4 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black ">
                                        4:ยังไม่ยืนยัน </span>
                                    @elseif ($row_master->status=='5')
                                    <span
                                        class="bg-green-500 text-white px-4 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black ">
                                        5:เผยแพร่แล้ว </span>
                                    @elseif ($row_master->status=='0')
                                    <span class="bg-red-200 text-red-600 rounded-full text-xs">Fail
                                    </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm">
                                    <div class="flex item-center justify-center">
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <a href="{{url('process5',$row_master->id)}}?direct=1">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg></a>
                                        </div>
                                        {{-- 
                                        @if ($row_master->status=='1')
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110"
                                            onclick="return confirm('ต้องการยกเลิกไฟล์นี้ ใช่หรือไม่ ??')">
                                            <a href="{{ url('datapolice/cancel',$row_master->id)}}">

                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                            </path>
                                        </svg>



                                        </a>
                                    </div>
                                    @else
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110"
                                        onclick="return confirm('คืนสถานะไฟล์นี้ ใช่หรือไม่ ??')">
                                        <a href="{{ url('datapolice/uncancel',$row_master->id)}}">

                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                                                </path>
                                            </svg>
                                        </a>
                                    </div>
                                    @endif --}}



                                    @if(Auth::user()->type=='admin')

                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110"
                                        onclick="return confirm('การลบข้อมูลนี้จะทำให้ข้อมูลของการประมวลผลนี้ทุกอย่างหายไป แน่ใจหรือไม่ ??')">
                                        <a href="{{ url('process/delete',$row_master->id)}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg> </a>
                                    </div>

                                    @endif
                </div>
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


    <!-- jQuery -->
    {{--   <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

        <!--Datatables -->
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script> --}}


    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    {{--    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js">
        </script> --}}
    <script src="{{ asset('js/pdfmake.min.js') }}"></script>
    {{--   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
        </script> --}}
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>


    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">

    <script src="{{ asset('js/vfs_fonts.js') }}"></script>



    <script>
        pdfMake.fonts = {
   THSarabun: {
     normal: 'THSarabun.ttf',
     bold: 'THSarabun-Bold.ttf',
     italics: 'THSarabun-Italic.ttf',
     bolditalics: 'THSarabun-BoldItalic.ttf'
   }
}


            $(document).ready(function() {
			
			var table = $('table.display').DataTable( {
					responsive: true,
                   // "order": [[ 0, "desc" ]]
                   aaSorting: [],
                    // Export Tools
                    dom: 'lBfrtip',
                    buttons: [
              {
                "extend": "copyHtml5",
                "text": "Copy",
                exportOptions: {
                 //   columns: [ 0, 1, 2, 3 ]
                }
              },
          /*     {
                "extend": "csv",
                "text": "CSV",
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                },
                "className": "btn btn-white btn-primary btn-bold"
              }, */
              {
                "extend": "excelHtml5",
                "text": "Excel",
                exportOptions: {
                   // columns: [  1, 2, 3 ]
                }
              },
             /*  {
                "extend": "pdf",
                "text": "PDF",
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                }
                
              }, */
              { // กำหนดพิเศษเฉพาะปุ่ม pdf
        "extend": 'pdfHtml5', // ปุ่มสร้าง pdf ไฟล์
        "text": 'PDF', // ข้อความที่แสดง
        "pageSize": 'A4',   // ขนาดหน้ากระดาษเป็น A4 
        
        "customize":function(doc){ // ส่วนกำหนดเพิ่มเติม ส่วนนี้จะใช้จัดการกับ pdfmake
            // กำหนด style หลัก
            doc.defaultStyle = {
                font:'THSarabun',
                fontSize:16                                 
            };
        },
        exportOptions: {
                  //  columns: [  1, 2, 3 ]
                }, 
                widths: [ '*', 'auto', 100, '*' ],
    }, // สิ้นสุดกำหนดพิเศษปุ่ม pdf
              {
                "extend": "print",
                "text": "Print",
                exportOptions: {
                  //  columns: [ 0, 1, 2, 3 ]
                },
                autoPrint: true,
                message: ''
              }		  
            ]

				} )
				.columns.adjust()
				//.responsive.recalc();
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