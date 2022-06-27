@section('title','จำนวนประชากร')
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
        <h3 class="text-gray-700 text-3xl font-medium">ข้อมูลจำนวนประชากร <a href="{{ route('population.create') }}"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">+
                เพิ่มจำนวนประชากรใหม่</a> </h3>

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

                        <table id="example" class="display stripe hover min-w-full"
                            style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        ID</th>
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        ปี</th>
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        จังหวัด</th>

                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        จำนวน</th>

                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    </th>

                                </tr>
                            </thead>

                            <tbody class="bg-white">

                                @forelse ($pop as $row)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="flex items-center">


                                            <div class="ml-4">
                                                <div class="text-sm leading-5 font-medium text-gray-900">
                                                    {{ $row->ID_POPULATION  ?? '-'}}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">{{ $row->YEAR  ?? '-'}}</div>

                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">

                                        <div class="text-sm leading-5 text-gray-900">{{ $row->PROV  ?? '-'}}

                                            [@switch($row->PROV)
                                            @case('10')กรุงเทพมหานคร@break
                                            @case('30')นครราชสีมา@break
                                            @case('20')ชลบุรี@break
                                            @case('50')เชียงใหม่@break
                                            @case('34')อุบลราชธานี@break
                                            @case('40')ขอนแก่น@break
                                            @case('57')เชียงราย@break
                                            @case('80')นครศรีธรรมราช@break
                                            @case('90')สงขลา@break
                                            @case('31')บุรีรัมย์@break
                                            @case('21')ระยอง@break
                                            @case('41')อุดรธานี@break
                                            @case('11')สมุทรปราการ@break
                                            @case('32')สุรินทร์@break
                                            @case('84')สุราษฎร์ธานี@break
                                            @case('60')นครสวรรค์@break
                                            @case('73')นครปฐม@break
                                            @case('13')ปทุมธานี@break
                                            @case('14')พระนครศรีอยุธยา@break
                                            @case('67')เพชรบูรณ์@break
                                            @case('65')พิษณุโลก@break
                                            @case('45')ร้อยเอ็ด@break
                                            @case('33')ศรีสะเกษ@break
                                            @case('19')สระบุรี@break
                                            @case('52')ลำปาง@break
                                            @case('72')สุพรรณบุรี@break
                                            @case('16')ลพบุรี@break
                                            @case('70')ราชบุรี@break
                                            @case('47')สกลนคร@break
                                            @case('71')กาญจนบุรี@break
                                            @case('22')จันทบุรี@break
                                            @case('24')ฉะเชิงเทรา@break
                                            @case('12')นนทบุรี@break
                                            @case('36')ชัยภูมิ@break
                                            @case('46')กาฬสินธุ์@break
                                            @case('62')กำแพงเพชร@break
                                            @case('25')ปราจีนบุรี@break
                                            @case('44')มหาสารคาม@break
                                            @case('27')สระแก้ว@break
                                            @case('74')สมุทรสาคร@break
                                            @case('77')ประจวบคีรีขันธ์@break
                                            @case('92')ตรัง@break
                                            @case('42')เลย@break
                                            @case('86')ชุมพร@break
                                            @case('96')นราธิวาส@break
                                            @case('94')ปัตตานี@break
                                            @case('56')พะเยา@break
                                            @case('76')เพชรบุรี@break
                                            @case('81')กระบี่@break
                                            @case('93')พัทลุง@break
                                            @case('51')ลำพูน@break
                                            @case('53')อุตรดิตถ์@break
                                            @case('63')ตาก@break
                                            @case('64')สุโขทัย@break
                                            @case('54')แพร่@break
                                            @case('66')พิจิตร@break
                                            @case('48')นครพนม@break
                                            @case('55')น่าน@break
                                            @case('95')ยะลา@break
                                            @case('26')นครนายก@break
                                            @case('35')ยโสธร@break
                                            @case('43')หนองคาย@break
                                            @case('18')ชัยนาท@break
                                            @case('83')ภูเก็ต@break
                                            @case('61')อุทัยธานี@break
                                            @case('39')หนองบัวลำภู@break
                                            @case('15')อ่างทอง@break
                                            @case('38')บึงกาฬ@break
                                            @case('23')ตราด@break
                                            @case('49')มุกดาหาร@break
                                            @case('17')สิงห์บุรี@break
                                            @case('82')พังงา@break
                                            @case('91')สตูล@break
                                            @case('37')อำนาจเจริญ@break
                                            @case('75')สมุทรสงคราม@break
                                            @case('58')แม่ฮ่องสอน@break
                                            @case('85')ระนอง@break
                                            @default
                                            <div
                                                class="group cursor-pointer relative inline-block 
                            p-2 my-2 bg-red-500 text-white rounded-md focus:outline-none focus:ring-2 ring-red-300 ring-offset-2">
                                                Error
                                                <div class=" opacity-0 w-28 bg-black text-white text-center text-xs
                                rounded-lg py-2 absolute z-10 group-hover:opacity-100 bottom-full
                                -left-1/2 ml-14 px-3 pointer-events-none">
                                                    ไม่พบรหัสจังหวัด
                                                </div>
                                            </div>
                                            @endswitch]

                                        </div>

                                    </td>

                                    <td
                                        class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                                        <div class="text-sm leading-5 text-gray-900">
                                            {{ number_format($row->AMOUNT)  ?? '-'}}</div>
                                    </td>

                                    <td
                                        class="px-6 py-4 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium">



                                        <form action="{{ route('population.destroy', $row->ID_POPULATION) }}"
                                            method="POST">



                                            <a href="{{ route('population.edit', $row->ID_POPULATION) }}"
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

                <div class="mt-8"></div>

                <h4 class="text-gray-700 text-3xl font-medium">ประวัติการอัพโหลด </h4> <span
                    class="text-sm">(ล่าสุดอยู่บน)</span>
                <!--Card-->
                <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">

                    <table id="example2" class="display stripe hover min-w-full"
                        style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    วันที่อัพโหลด</th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    ไฟล์</th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    แดง</th>

                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    เหลือง</th>

                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    เทา
                                </th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    สมบูรณ์
                                </th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    ทั้งหมด
                                </th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    โดย
                                </th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    หมายเหตุ
                                </th>

                            </tr>
                        </thead>

                        <tbody class="bg-white">

                            @forelse ($pop_history as $row_hi)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex items-center">


                                        <div class="ml-4">
                                            <div class="text-sm leading-5 font-medium text-gray-900">

                                                {{ Carbon\Carbon::parse($row_hi['created_at'])->addYear(543)->format('d/m/Y') }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">
                                        <a href="{{ asset('storage/population/'.$row_hi->filename) }}"
                                            target="_blank">{{ $row_hi->filename ?? '' }}</a> </div>

                                </td>


                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">

                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ $row_hi->err ?? '' }} </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">

                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ $row_hi->war ?? '' }} </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">

                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ $row_hi->lost ?? '' }} </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">

                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ $row_hi->com ?? '' }} </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">

                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ $row_hi->rec_all ?? '' }} </div>
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ $row_hi->user->name ?? '' }} [{{$row_hi->user->department ?? ''}}] </div>
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ $row_hi->note ?? '' }} </div>
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