@section('title','ข้อมูลมรณบัตร')
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

        <h4 class="text-gray-700 text-3xl font-medium ">

            <div class="inline-block">
                <button
                    class=" p-3 flex items-center bg-gray-500 text-blue-50 max-w-max shadow-sm hover:shadow-lg rounded-full w-12 h-12 "
                    onclick="history.back()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0019 16V8a1 1 0 00-1.6-.8l-5.333 4zM4.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0011 16V8a1 1 0 00-1.6-.8l-5.334 4z">
                        </path>
                    </svg>
                </button>
            </div>
            ข้อมูล มรณบัตร ข้อมูลผู้เสียชีวิตปี
            {{ $master->death_year+543 ?? '' }} | สถานะ
            : @if ($master->status=='1')
            <span
                class="focus:outline-none text-white text-lg py-2.5 px-5 rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg">พร้อมใช้</span>
            @elseif ($master->status=='0')
            <span
                class="focus:outline-none text-white text-lg py-2.5 px-5 rounded-md bg-red-500 hover:bg-red-600 hover:shadow-lg">ยกเลิก</span>
            @endif

        </h4>
        <div class="flex flex-col ">
            <div class="my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">

                {{-- ข้อมูลไฟล์ --}}


                <div class="leading-loose">
                    <form class="w-full m-4 p-10 bg-white rounded shadow-xl">
                        <div class="inline-block mt-2 -mx-1 pl-1 w-1/3">
                            <label class="block text-sm text-gray-00" for="cus_name">ไฟล์</label>
                            <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="cus_name"
                                name="cus_name" type="text" value="{{ $master->filename ?? ''}}" readonly>
                        </div>

                        <div class="inline-block mt-2 -mx-1 pl-1 w-1/3">
                            <label class=" block text-sm text-gray-600" for="cus_email">อัพโหลดโดย</label>
                            <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="cus_email"
                                name="cus_email" type="text" readonly
                                value="{{ $master->user->name ?? '' }} [{{$master->user->department}}] ">
                        </div>

                        <div class="inline-block mt-2 -mx-1 pl-1 w-1/3">
                            <label class=" block text-sm text-gray-600" for="cus_email">เมื่อ</label>
                            <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="cus_email"
                                name="cus_email" type="text" readonly
                                value=" {{ Carbon\Carbon::parse($master['created_at'])->addYear(543)->format('d/m/Y H:i:s') }}">
                        </div>


                        <div class="inline-block mt-2 w-1/4 pr-1">
                            <label class=" block text-sm text-gray-600" for="cus_email">error</label>
                            <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="cus_email"
                                name="cus_email" type="text" readonly value="{{ $master->err ?? ''}}">
                        </div>
                        <div class="inline-block mt-2 -mx-1 pl-1 w-1/4">
                            <label class=" block text-sm text-gray-600" for="cus_email">Warning</label>
                            <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="cus_email"
                                name="cus_email" type="text" readonly value="{{ $master->war ?? ''}}">
                        </div>

                        <div class="inline-block mt-2 -mx-1 pl-1 w-1/4">
                            <label class=" block text-sm text-gray-600" for="cus_email">lost</label>
                            <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="cus_email"
                                name="cus_email" type="text" readonly value="{{ $master->lost ?? ''}}">
                        </div>

                        <div class="inline-block mt-2 -mx-1 pl-1 w-1/4">
                            <label class=" block text-sm text-gray-600" for="cus_email">complate</label>
                            <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="cus_email"
                                name="cus_email" type="text" readonly value="{{ $master->com ?? ''}}">
                        </div>

                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="cus_email">หมายเหตุ</label>
                            <input class="w-full px-2  py-2 text-gray-700 bg-gray-200 rounded" id="cus_email"
                                name="cus_email" type="text" readonly placeholder="" value="{{ $master->note ?? ''}}">
                        </div>


                    </form>
                </div>



                {{--  <div class="mt-8"></div> --}}


                {{-- ข้อมูลรายการ Prepare and RAW --}}
                <div class="relative h-16 w-100">
                    <h4 class="text-gray-700 text-3xl font-medium">ข้อมูลจากไฟล์ Prepare And Raw </h4>
                    <div class="absolute top-0 right-0 h-16 w-100 ">

                        <a href="{{ url('datadeathcert/exportprepare/'.$master->id) }}">

                            <button
                                class="bg-grey-light hover:bg-blue text-blue-darkest font-bold py-2 px-4 rounded inline-flex items-center  rounded-full border border-blue-600 text-blue-600 ">
                                <svg class="w-4 h-4 mr-2 text-blue-600" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" /></svg>
                                <span>XLS Prepare & Raw</span>
                            </button>
                        </a>
                        <a href="{{ asset('storage/deathcert/'.$master->filename) }}" target="_blank">
                            <button
                                class="bg-grey-light hover:bg-blue text-blue-darkest font-bold py-2 px-4 rounded inline-flex items-center  rounded-full border border-red-600 text-red-600 ">
                                <svg class="w-4 h-4 mr-2 text-blue-600" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" /></svg>
                                <span>Original file</span>
                            </button></a>



                    </div>
                </div>
                <!--Card-->


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


        <!-- jQuery -->
        {{--   <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

        <!--Datatables -->
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script> --}}


        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js">
        </script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js">
        </script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
        </script>
        {{--    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js">
        </script> --}}
        <script src="{{ asset('js/pdfmake.min.js') }}"></script>
        {{--   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
        </script> --}}
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js">
        </script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js">
        </script>


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
        <script>
            var openmodal = document.querySelectorAll('.modal-open')
    for (var i = 0; i < openmodal.length; i++) {
      openmodal[i].addEventListener('click', function(event){
    	event.preventDefault()
    	toggleModal()
      })
    }
    
    const overlay = document.querySelector('.modal-overlay')
    overlay.addEventListener('click', toggleModal)
    
    var closemodal = document.querySelectorAll('.modal-close')
    for (var i = 0; i < closemodal.length; i++) {
      closemodal[i].addEventListener('click', toggleModal)
    }
    
    document.onkeydown = function(evt) {
      evt = evt || window.event
      var isEscape = false
      if ("key" in evt) {
    	isEscape = (evt.key === "Escape" || evt.key === "Esc")
      } else {
    	isEscape = (evt.keyCode === 27)
      }
      if (isEscape && document.body.classList.contains('modal-active')) {
    	toggleModal()
      }
    };
    
    
    function toggleModal () {
      const body = document.querySelector('body')
      const modal = document.querySelector('.modal')
      modal.classList.toggle('opacity-0')
      modal.classList.toggle('pointer-events-none')
      body.classList.toggle('modal-active')
    }
    
     
        </script>


</x-app-layout>