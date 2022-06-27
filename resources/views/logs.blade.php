@section('title','ประวัติการใช้งาน (Log)')
@section('subtitle',Request::path() )
<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">ประวัติการใช้งาน</h3>



        {{-- start loadpage --}}
        <div id="hidepage2" style="display:block;" align="center" width="100%">
            <br>
            <IMG SRC="{{ asset('storage/loading.gif') }}" WIDTH="100" HEIGHT="100" BORDER="0" ALT=""><br>
            กรุณารอสักครู่...
        </div>

        <div id="hidepage" style="display:none;">
        </div>
        {{-- end loadpage --}}




        <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">

            <table id="deathcert_history example2" class="display stripe hover min-w-full"
                style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                    <tr>
                        <th
                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            ผู้ใช้งาน</th>
                        <th
                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            ตำแหน่ง / หน่วยงาน</th>


                        <th
                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            วันที่ / เวลา</th>
                        <th
                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            รายละเอียด</th>

                    </tr>
                </thead>

                <tbody class="bg-white">

                    @forelse ($logs as $row)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full object-cover"
                                        src="{{ @$row->user->profile_photo_path === null ? asset('storage/no-avatar.png')  : asset('storage/'.$row->user->profile_photo_path) }}"
                                        alt="">
                                </div>

                                <div class="ml-4">
                                    <div class="text-sm leading-5 font-medium text-gray-900">
                                        {{ $row->user->name  ?? '-'}}
                                    </div>
                                    <div class="text-sm leading-5 text-gray-500">
                                        {{ $row->user->email  ?? '-'}}</div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="text-sm leading-5 text-gray-900">{{ $row->user->position  ?? '-'}}</div>
                            <div class="text-sm leading-5 text-gray-500">{{ $row->user->department  ?? '-'}}
                            </div>
                            <div class="text-sm leading-5 text-gray-900">{{ $row->user->type  ?? '-'}}</div>
                        </td>



                        <td
                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                            {{ Carbon\Carbon::parse($row['created_at'])->addYear(543)->format('d/m/Y H:i:s') }}
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm">
                            {{ $row->action  ?? '-' }}
                        </td>


                    </tr>

                    @empty

                    @endforelse
                </tbody>

            </table>


        </div>
        <!--/Card-->



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