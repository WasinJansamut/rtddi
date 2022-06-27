@section('title','Import2')
@section('subtitle',Request::path() )
<x-app-layout>

    <style>
        input.text {
            focus: ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300
        }
    </style>
    <div class=" mx-auto px-6 py-8">
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
                                        class="bg-green-300 rounded-lg flex items-center justify-center border border-gray-200">
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
                                            class="w-2/3 bg-green-200 h-24 flex flex-col items-center justify-center px-1 rounded-r-lg body-step">
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
                                        class="bg-gray-300 rounded-lg flex items-center justify-center border border-gray-200">
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
                                            class="w-2/3 bg-gray-200 h-24 flex flex-col items-center justify-center px-1 rounded-r-lg body-step">
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


                    <form action="{{ route('import3') }}" method="POST" id="import3" enctype="multipart/form-data">
                        @csrf
                        <!--Card-->
                        <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">



                            <div class="p-2 text-center">


                                @if(!empty($message))


                                <div class="py-3 px-2 my-2 bg-green-300 text-green-800 rounded border border-green-600">
                                    {{ $message }}</div>

                                @endif

                                @if(!empty($error))


                                <div class="py-3 px-2 my-2 bg-red-300 text-green-800 rounded border border-red-600">
                                    {{ $message }}</div>

                                @endif

                            </div>


                            {{-- Checklist --}}
                            <div class="text-center">
                                <a class='bg-blue-500 py-2 px-5 text-white rounded modal-open text-center'
                                    data-toggle="modal" data-target="firstModal">รายการที่ตรวจเช็ค
                                </a>

                            </div>


                            <div class="modal  opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center"
                                id="firstModal">

                                <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50">
                                </div>

                                <div class="modal-container bg-white w-full
                                md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

                                    <div
                                        class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                                        <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg"
                                            width="18" height="18" viewBox="0 0 18 18">
                                            <path
                                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                            </path>
                                        </svg>
                                        <span class="text-sm">(Esc)</span>


                                    </div>


                                    <!-- Add margin if you want to see some of the overlay behind the modal-->
                                    <div class="modal-content text-left px-12 py-6">

                                        <button
                                            class="p-2 my-2 bg-red-500 text-white rounded-md focus:outline-none focus:ring-2 ring-red-300 ring-offset-2">Error
                                        </button>(Non useable : เมื่อนำเข้าระบบแล้วมีผลต่อการประมวลผล )<br>

                                        - รหัสจังหวัด ต้องตรงตามที่กำหนดเท่านั้น <br>
                                        <hr>
                                        <button
                                            class="p-2 my-2 bg-yellow-500 text-white rounded-md focus:outline-none focus:ring-2 ring-yellow-300 ring-offset-2">Warning</button>(Not
                                        Complate : ไม่สมบูรณ์)<br>

                                        - จำนวนประชากรต่อจังหวัด ไม่น่าเกิน หลักล้าน (7หลัก) <br>
                                        <hr>
                                        <button
                                            class="p-2 my-2 bg-gray-500 text-white rounded-md focus:outline-none focus:ring-2 ring-gray-300 ring-offset-2">Lost</button>(ข้อมูลที่ไม่สมควรเป็นค่าว่าง
                                        แต่ว่าง)<br>

                                        - ข้อมูลที่ไม่สมควรว่าง แต่เป็นค่าว่างมา <br>
                                        <hr>
                                        <button
                                            class="p-2 my-2 bg-green-500 text-white rounded-md focus:outline-none focus:ring-2 ring-green-300 ring-offset-2">Complete</button>(Complete
                                        : ข้อมูลสมบูรณ์ตามเกณฑ์)<br>

                                        - หากข้อมูลสมบูรณ์ จะไม่มี icon ใดๆขึ้นมา<br>

                                    </div>
                                </div>

                                <div class="flex justify-between items-center pb-3">
                                    <div class="modal-close cursor-pointer z-50">

                                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg"
                                            width="18" height="18" viewBox="0 0 18 18">
                                            <path
                                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>


                            <script>
                                var openmodal = document.querySelectorAll('.modal-open')
    let selectedModalTargetId = ''
    for (var i = 0; i < openmodal.length; i++) {
      openmodal[i].addEventListener('click', function(event){
        selectedModalTargetId = event.target.attributes.getNamedItem('data-target').value
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
   }
 
   function toggleModal () {
     if(!selectedModalTargetId) {
       return
     }
     const body = document.querySelector('body')
     const modal = document.getElementById(selectedModalTargetId)
     modal.classList.toggle('opacity-0')
     modal.classList.toggle('pointer-events-none')
     body.classList.toggle('modal-active')
   }
                            </script>


                            {{-- Checklist --}}

                            @php
                            $err = 0 ;
                            $war = 0 ;
                            $los = 0 ;
                            $com = 0 ;
                            @endphp
                            <div class="md:px-32 py-8 w-full">
                                <div class="shadow overflow-hidden rounded border-b border-gray-200">


                                    <table class="border-collapse w-full">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                                    ปี</th>
                                                <th
                                                    class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                                    รหัสจังหวัด</th>
                                                <th
                                                    class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                                    จังหวัด</th>
                                                <th
                                                    class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                                    จำนวน</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($data[0] as $row)
                                            <tr
                                                class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                                <td
                                                    class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">

                                                    {{ $row['year'] ?? ''}}
                                                </td>
                                                <td
                                                    class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                                    {{ $row['prov'] ?? ''}}

                                                </td>

                                                <td
                                                    class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                                    @switch($row['prov'])
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
                                                    @case('85')ระนอง
                                                    @break

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
                                                    @php
                                                    $err = $err + 1 ;
                                                    @endphp
                                                    @endswitch
                                                </td>
                                                <td
                                                    class="w-full lg:w-auto p-3 text-gray-800 text-right border border-b text-center block lg:table-cell relative lg:static">
                                                    {{ number_format($row['amount']) ?? ''}}
                                                    @if (strlen($row['amount'])>7)
                                                    <div
                                                        class="group cursor-pointer relative inline-block 
                                                p-2 my-2 bg-yellow-500 text-white rounded-md focus:outline-none focus:ring-2 ring-yellow-300 ring-offset-2">
                                                        Warning
                                                        <div class=" opacity-0 w-28 bg-black text-white text-center text-xs
                                                rounded-lg py-2 absolute z-10 group-hover:opacity-100 bottom-full
                                                -right-1/2 ml-14 px-3 pointer-events-none">
                                                            ตัวเลขเกิน 7 หลัก
                                                        </div>
                                                    </div>
                                                    @php
                                                    $war = $war + 1 ;
                                                    @endphp
                                                    @endif
                                                </td>

                                            </tr>
                                            @empty
                                            <tr class="text-center">
                                                <td colspan="3">--ไม่มีข้อมูล--</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>





                                    </table>
                                </div>
                            </div>


                            <hr>

                            <!-- infomation -->
                            <div class="heading text-center font-bold text-2xl m-5 text-gray-800">ข้อมูลไฟล์</div>
                            <style>
                                body {
                                    background: white !important;
                                }
                            </style>
                            <div
                                class="editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl">
                                <input class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none"
                                    spellcheck="false" type="text" required name="filename"
                                    value="{{ $fileName ?? '' }}" readonly>
                                <textarea
                                    class="description bg-gray-100 sec p-3 h-60 border border-gray-300 outline-none"
                                    spellcheck="false" name="note" placeholder="หมายเหตุ (ระบุ)"></textarea>

                            </div>

                            <!-- infomation -->


                            <hr>




                            <div class="w-2/3 mx-auto">
                                <div class="bg-white shadow-md rounded my-6">
                                    <table class="text-center w-full border-collapse">
                                        <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
                                        <thead>
                                            <tr>
                                                <th
                                                    class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                                    รายการ</th>
                                                <th
                                                    class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                                    จำนวน</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="hover:bg-grey-lighter">
                                                <td class="py-4 px-6 border-b border-grey-light">
                                                    <button
                                                        class="p-2 my-2 bg-red-500 text-white rounded-md focus:outline-none focus:ring-2 ring-red-300 ring-offset-2">Error
                                                    </button></td>
                                                <td class="py-4 px-6 border-b border-grey-light">
                                                    {{ $err }}
                                                    <input type="hidden" name="err" value="{{ $err }}">
                                                </td>
                                            </tr>

                                            <tr class="hover:bg-grey-lighter">
                                                <td class="py-4 px-6 border-b border-grey-light">
                                                    <button
                                                        class="p-2 my-2 bg-yellow-500 text-white rounded-md focus:outline-none focus:ring-2 ring-yellow-300 ring-offset-2">Warning</button>
                                                </td>
                                                <td class="py-4 px-6 border-b border-grey-light">
                                                    {{ $war }}
                                                    <input type="hidden" name="war" value="{{ $war }}">
                                                </td>
                                            </tr>


                                            <tr class="hover:bg-grey-lighter">
                                                <td class="py-4 px-6 border-b border-grey-light">
                                                    <button
                                                        class="p-2 my-2 bg-gray-500 text-white rounded-md focus:outline-none focus:ring-2 ring-gray-300 ring-offset-2">Lost</button>
                                                </td>
                                                <td class="py-4 px-6 border-b border-grey-light">
                                                    {{ $los }}
                                                    <input type="hidden" name="lost" value="{{ $los }}">
                                                </td>
                                            </tr>

                                            <tr class="hover:bg-grey-lighter">
                                                <td class="py-4 px-6 border-b border-grey-light">
                                                    <button
                                                        class="p-2 my-2 bg-green-500 text-white rounded-md focus:outline-none focus:ring-2 ring-green-300 ring-offset-2">Complete</button>
                                                </td>
                                                <td class="py-4 px-6 border-b border-grey-light">
                                                    {{ $c_data-($err+$war+$los)  }} / {{ $c_data }}
                                                    <input type="hidden" name="com"
                                                        value="{{ $c_data-($err+$war+$los)  }}">

                                                    <input type="hidden" name="rec_all" value="{{ $c_data }}">
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>



                            <div class="row">
                                <div class="w-full mx-auto">
                                    <div class="sm:grid grid-cols-4 gap-5 mx-auto px-16">
                                        <div class="col-start-1 col-end-3 my-2">
                                            <a href="{{ route('population.create') }}">
                                                <div
                                                    class="h-full p-6 dark:bg-gray-800 bg-white hover:shadow-xl rounded border-b-4 border-red-500 shadow-md">
                                                    <h3 class="text-2xl mb-3 font-semibold inline-flex">
                                                        <svg class="mr-2" width="24" height="30" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M1.02698 11.9929L5.26242 16.2426L6.67902 14.8308L4.85766 13.0033L22.9731 13.0012L22.9728 11.0012L4.85309 11.0033L6.6886 9.17398L5.27677 7.75739L1.02698 11.9929Z"
                                                                fill="currentColor" /></svg>
                                                        ย้อนกลับ
                                                    </h3>
                                                    <p class="text-lg">ไปหน้าอัพโหลด</p>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-end-5 col-span-2 my-2 ">
                                            <a href="#" onclick="document.getElementById('import3').submit();">
                                                <div
                                                    class="h-full p-6 dark:bg-gray-800 bg-white hover:shadow-xl rounded border-b-4 border-red-500 shadow-md text-right">
                                                    <h3 class="text-2xl mb-3 font-semibold inline-flex ">
                                                        บันทึก

                                                        <svg class="ml-2" width="24" height="30" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M23.0677 11.9929L18.818 7.75739L17.4061 9.17398L19.2415 11.0032L0.932469 11.0012L0.932251 13.0012L19.2369 13.0032L17.4155 14.8308L18.8321 16.2426L23.0677 11.9929Z"
                                                                fill="currentColor" /></svg>
                                                    </h3>
                                                    <p class="text-lg">บันทึกข้อมูลเข้าฐานข้อมูล</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/Card-->

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>