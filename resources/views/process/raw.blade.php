@section('title','ข้อมูลดิบหลังการบูรณาการ')
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

                <h4 class="text-gray-700 text-3xl font-medium">ข้อมูลดิบหลังการบูรณาการ</h4> <span
                    class="text-sm">กรุณาเลือกปีที่ต้องการ</span>
                <!--Card-->


                @if(session('success'))<div
                    class="py-3 px-2 my-2 bg-green-300 text-green-800 rounded border border-green-600">
                    {{session('success')}}</div>
                @endif

                <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                    <form name="frm_export" method="GET" action="{{ url('processexportfinal') }}">
                        <div class="flex flex-col mt-8 w-full md:w-auto item-center text-center">
                            <div class='w-full md:w-full px-3 mb-6'>
                                <label
                                    class='block uppercase tracking-wide text-gray-700 text-xl font-bold mb-2 inline-block'>ปีที่ต้องการข้อมูลดิบ<select
                                        name="dead_year"
                                        class="block appearance-none text-gray-600 w-full bg-white border border-gray-400 shadow-inner px-4 py-2 pr-8 rounded">
                                        @for($y = date('Y'); $y >= 2011 ; $y--)
                                        <option value="{{$y+543}}" {{ $y == @$year_en ? "selected" : "" }}>{{$y+543}}
                                        </option>
                                        @endfor

                                    </select></label> <br>
                                <button
                                    class="bg-grey-light hover:bg-green text-green-darkest font-bold py-2 px-4 rounded inline-flex items-center  rounded-full border border-green-600 text-green-600 "
                                    type="submit">
                                    <svg class="w-4 h-4 mr-2 text-blue-600" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" /></svg>
                                    <span>Download</span>
                                </button>

                                <div class="mt-4"></div>
                                <a href="{{ asset('storage/RTDDI data dictionary.xlsx') }}">

                                    <button
                                        class="bg-grey-light hover:bg-blue text-blue-darkest font-bold py-2 px-4 rounded inline-flex items-center  rounded-full border border-blue-600 text-blue-600 "
                                        type="button">
                                        <svg class="w-4 h-4 mr-2 text-blue-600" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" /></svg>
                                        <span>data dictionary</span>
                                    </button>
                                </a>

                            </div>

                        </div>
                        @csrf
                    </form>




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