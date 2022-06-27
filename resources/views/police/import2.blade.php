@section('title','แสดงผลข้อมูล ตำรวจ')
@section('subtitle',Request::path() )
<meta http-equiv="content-type" content="text/plain; charset=UTF-8" />
<x-app-layout>

    <script src="{{ URL::asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/jquery.table2excel.js')}}"></script>
    <style>
        input.text {
            @apply focus: ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300
        }
    </style>

    <style>
        .animated {
            -webkit-animation-duration: 1s;
            animation-duration: 1s;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
        }

        .animated.faster {
            -webkit-animation-duration: 500ms;
            animation-duration: 500ms;
        }

        .fadeIn {
            -webkit-animation-name: fadeIn;
            animation-name: fadeIn;
        }

        .fadeOut {
            -webkit-animation-name: fadeOut;
            animation-name: fadeOut;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }
    </style>

    <div class=" mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">ตรวจเช็คข้อมูลที่ต้องการนำเข้า</h3>

        {{-- start loadpage container --}}
        <div id="hidepage2" style="display:block;" align="center" width="100%">
            <br>
            <IMG SRC="{{ asset('storage/loading.gif') }}" WIDTH="100" HEIGHT="100" BORDER="0" ALT=""><br>
            กรุณารอสักครู่...
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
                                                เช็คข้อมูลที่ไม่ถูกต้องแล้วนำกลับไปแก้ไข หากแน่ใจแล้ว ให้กด "บันทึก"
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



                    <form action="{{ route('importpolice3') }}" method="POST" id="import3"
                        enctype="multipart/form-data">
                        @csrf
                        <!--Card-->
                        <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">



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



                            @php
                            $no = 2 ; //นับหัวตารางเป็น 1 ใน excel
                            $err = 0 ;
                            $war = 0 ;
                            $los = 0 ;
                            $com = 0 ;


                            @endphp


                            <button type="button" onclick="openModal()"
                                class='bg-blue-500 text-white p-2 rounded text-2xl font-bold'>ตรวจสอบให้แน่ใจว่า
                                พาหนะจากฐานข้อมูลตำรวจตรงตามที่กำหนด</button>


                            <div class="main-modal fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
                                style="background: rgba(0,0,0,.7);">
                                <div
                                    class="border border-teal-500 shadow-lg modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                                    <div class="modal-content py-4 text-left px-6">
                                        <!--Title-->
                                        <div class="flex justify-between items-center pb-3">
                                            <p class="text-2xl font-bold">ข้อมูลพาหนะที่นำเข้าต้องเป็นตัวเลขเท่านั้น
                                            </p>
                                            <div class="modal-close cursor-pointer z-50">
                                                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg"
                                                    width="18" height="18" viewBox="0 0 18 18">
                                                    <path
                                                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                        <!--Body-->
                                        <div class="my-5">
                                            <table width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td>01</td>
                                                        <td>รถยนต์ส่วนบุคคล</td>
                                                    </tr>
                                                    <tr>
                                                        <td>02</td>
                                                        <td>รถจักรยานยนต์ 2 ล้อ (จยย.)</td>
                                                    </tr>
                                                    <tr>
                                                        <td>03</td>
                                                        <td>รถยนต์ 3 ล้อ (3 ล้อเครื่อง)</td>
                                                    </tr>
                                                    <tr>
                                                        <td>04</td>
                                                        <td>รถยนต์นั่งสาธารณะ (แท็กซี่)</td>
                                                    </tr>
                                                    <tr>
                                                        <td>05</td>
                                                        <td>รถกระบะ (ปิคอัพ)</td>
                                                    </tr>
                                                    <tr>
                                                        <td>06</td>
                                                        <td>รถโดยสารขนาดเล็ก (ตู้)</td>
                                                    </tr>
                                                    <tr>
                                                        <td>07</td>
                                                        <td>รถโดยสารขนาดใหญ่</td>
                                                    </tr>
                                                    <tr>
                                                        <td>08</td>
                                                        <td>รถรับส่งนักเรียน</td>
                                                    </tr>
                                                    <tr>
                                                        <td>09</td>
                                                        <td>รถจักรยาน 2 ล้อ</td>
                                                    </tr>
                                                    <tr>
                                                        <td>10</td>
                                                        <td>รถจักรยาน 3 ล้อ (3 ล้อถีบ)</td>
                                                    </tr>
                                                    <tr>
                                                        <td>11</td>
                                                        <td>รถบรรทุก 6 ล้อ</td>
                                                    </tr>
                                                    <tr>
                                                        <td>12</td>
                                                        <td>รถบรรทุก 10 ล้อ</td>
                                                    </tr>
                                                    <tr>
                                                        <td>13</td>
                                                        <td>รถบรรทุกพ่วง</td>
                                                    </tr>
                                                    <tr>
                                                        <td>14</td>
                                                        <td>รถกึ่งพ่วง</td>
                                                    </tr>
                                                    <tr>
                                                        <td>16</td>
                                                        <td>อื่นๆ</td>
                                                    </tr>
                                                    <tr>
                                                        <td>18</td>
                                                        <td>รถใช้เพื่อการเกษตร</td>
                                                    </tr>
                                                    <tr>
                                                        <td>19</td>
                                                        <td>รถอีแต๋น</td>
                                                    </tr>
                                                    <tr>
                                                        <td>20</td>
                                                        <td>พ่วงข้าง</td>
                                                    </tr>
                                                    <tr>
                                                        <td>99</td>
                                                        <td>รถอีโก๋ง</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <script>
                                const modal = document.querySelector('.main-modal');
const closeButton = document.querySelectorAll('.modal-close');

const modalClose = () => {
modal.classList.remove('fadeIn');
modal.classList.add('fadeOut');
setTimeout(() => {
modal.style.display = 'none';
}, 500);
}

const openModal = () => {
modal.classList.remove('fadeOut');
modal.classList.add('fadeIn');
modal.style.display = 'flex';
}

for (let i = 0; i < closeButton.length; i++) {

const elements = closeButton[i];

elements.onclick = (e) => modalClose();

modal.style.display = 'none';

window.onclick = function (event) {
if (event.target == modal) modalClose();
}
}
                            </script>


                            <div class="md:px-32 py-8 w-full">




                                <div class="shadow overflow-hidden rounded border-b border-gray-200">
                                    @if ($chk_show=='1')

                                    @include('police.table.table_main',
                                    ['title' => 'ข้อมูลที่นำเข้า'])

                                    @endif

                                </div>
                            </div>


                            <input type="button" onclick="tableToExcel()" value="Export รายชื่อที่พบปัญหา"
                                class="mt-4 inline-flex items-center justify-center px-4 py-2 text-base leading-5 rounded-md border font-medium shadow-sm transition ease-in-out duration-150 focus:outline-none focus:shadow-outline bg-blue-600 border-blue-600 text-gray-100 hover:bg-blue-500 hover:border-blue-500 hover:text-gray-100">


                            <div class="table2excel">


                                @if ($dis_err!='1')

                                @include('police.table.table1',
                                ['title' => '01- ตัวแปรสำคัญ เป็นค่าว่าง CID Fname Lname <button
                                    class="p-2 my-2 bg-red-500 text-white rounded-md focus:outline-none focus:ring-2 ring-red-300 ring-offset-2"
                                    type="button">Error</button>',
                                'list' => $chk_List1])

                                <hr>


                                @include('police.table.table1',
                                ['title' => '02- มีช่องว่างและอักขระพิเศษใน CID <button
                                    class="p-2 my-2 bg-red-500 text-white rounded-md focus:outline-none focus:ring-2 ring-red-300 ring-offset-2"
                                    type="button">Error</button>',
                                'list' => $chk_List2])
                                <hr>

                                @include('police.table.table1',
                                ['title' => '03- มีช่องว่างและอักขระพิเศษใน ชื่อ หรือ นามสกุล <button
                                    class="p-2 my-2 bg-red-500 text-white rounded-md focus:outline-none focus:ring-2 ring-red-300 ring-offset-2"
                                    type="button">Error</button>',
                                'list' => $chk_List3])
                                <hr>

                                @include('police.table.table2',
                                ['title' => ' 04 ปีที่เสียชีวิต ไม่อยู่ในปีที่เลือก <button
                                    class="p-2 my-2 bg-red-500 text-white rounded-md focus:outline-none focus:ring-2 ring-red-300 ring-offset-2"
                                    type="button">Error</button>',
                                'list' => $chk_List4])
                                <hr>

                                @include('police.table.table1',
                                ['title' => ' 05 ข้อมูลที่ซ้ำกันเองในฐาน เช็คจาก CID Fname Lname <button
                                    class="p-2 my-2 bg-red-500 text-white rounded-md focus:outline-none focus:ring-2 ring-red-300 ring-offset-2"
                                    type="button">Error</button>',
                                'list' => $chk_List5])
                                <hr>

                                @include('police.table.table2',
                                ['title' => ' 06 วันเดือนปีที่เสียชีวิต ไม่ตรงกับความเป็นจริง (หากเป็น 00 มา
                                ระบบจะแก้ไขให้เป็น 01) <button
                                    class="p-2 my-2 bg-yellow-500 text-white rounded-md focus:outline-none focus:ring-2 ring-yellow-300 ring-offset-2"
                                    type="button">Warning</button>',
                                'list' => $chk_List6])
                                <hr>


                                @include('police.table.table3',
                                ['title' => '07 วันเดือนปีที่เกิดไม่มี ระบบจะนำอายุจากฐานข้อมูลดิบมาแสดงในตัวแปรอายุ
                                <button
                                    class="p-2 my-2 bg-yellow-500 text-white rounded-md focus:outline-none focus:ring-2 ring-yellow-300 ring-offset-2"
                                    type="button">Warning</button>',
                                'list' => $chk_List7])
                                <hr>

                                @include('police.table.table4',
                                ['title' => '08 วันเกิด อยู่หลังวันที่เสียชีวิต (ตายก่อนเกิด) <button
                                    class="p-2 my-2 bg-red-500 text-white rounded-md focus:outline-none focus:ring-2 ring-red-300 ring-offset-2"
                                    type="button">Error</button>',
                                'list' => $chk_List8])
                                <hr>


                                @include('police.table.table1',
                                ['title' => '09 สัญชาติไทย แต่เลขบัตรไม่ครบ 13 หลัก <button
                                    class="p-2 my-2 bg-red-500 text-white rounded-md focus:outline-none focus:ring-2 ring-red-300 ring-offset-2"
                                    type="button">Error</button>',
                                'list' => $chk_List9])
                                <hr>

                                @include('police.table.table5',
                                ['title' => '10 คำนำหน้ากับเพศไม่สอดคล้องกัน (ระบบจะลงเพศให้ โดยใช้คำนำหน้า) <button
                                    class="p-2 my-2 bg-red-500 text-white rounded-md focus:outline-none focus:ring-2 ring-red-300 ring-offset-2"
                                    type="button">Error</button>',
                                'list' => $chk_List10])
                                <hr>

                                @include('police.table.table4',
                                ['title' => '11 อายุกับคำนำหน้าไม่สอดคล้องกัน <button
                                    class="p-2 my-2 bg-red-500 text-white rounded-md focus:outline-none focus:ring-2 ring-red-300 ring-offset-2"
                                    type="button">Error</button>',
                                'list' => $chk_List11])
                                <hr>




                                @include('police.table.table6',
                                ['title' => '12 รหัสถานีตำรวจไม่มีในฐานข้อมูล <button
                                    class="p-2 my-2 bg-red-500 text-white rounded-md focus:outline-none focus:ring-2 ring-red-300 ring-offset-2"
                                    type="button">Error</button>',
                                'list' => $chk_List12])
                                <hr>

                                @include('police.table.table4',
                                ['title' => '13 วันเกิดผิดปกติ (น้อยกว่าปี 1900 มากกว่าปีปัจจุบัน) <button
                                    class="p-2 my-2 bg-yellow-500 text-white rounded-md focus:outline-none focus:ring-2 ring-yellow-300 ring-offset-2"
                                    type="button">Warning</button>',
                                'list' => $chk_List13])
                                <hr>


                                @endif

                            </div>


                            @php
                            $err = count($chk_List1) + count($chk_List2) + count($chk_List3) + count($chk_List4) +
                            count($chk_List5) + count($chk_List8)+ count($chk_List9)+ count($chk_List10)+
                            count($chk_List11)+
                            count($chk_List12) ;

                            $war = count($chk_List6) + count($chk_List7) + count($chk_List13) ;

                            @endphp

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

                                <input class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none"
                                    spellcheck="false" type="text" required name="death_year"
                                    value="{{ $death_year ?? '' }}" readonly>



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
                                                    class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg: table-cell">
                                                    รายการ</th>
                                                <th
                                                    class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg: table-cell">
                                                    จำนวน</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="hover:bg-grey-lighter">
                                                <td class="py-4 px-6 border-b border-grey-light">
                                                    <button
                                                        class="p-2 my-2 bg-red-500 text-white rounded-md focus:outline-none focus:ring-2 ring-red-300 ring-offset-2"
                                                        type="button">Error
                                                    </button>
                                                <td class="py-4 px-6 border-b border-grey-light">
                                                    {{ $err }}
                                                    <input type="hidden" name="err" value="{{ $err }}">

                                            </tr>

                                            <tr class="hover:bg-grey-lighter">
                                                <td class="py-4 px-6 border-b border-grey-light">
                                                    <button
                                                        class="p-2 my-2 bg-yellow-500 text-white rounded-md focus:outline-none focus:ring-2 ring-yellow-300 ring-offset-2"
                                                        type="button">Warning</button>

                                                <td class="py-4 px-6 border-b border-grey-light">
                                                    {{ $war }}
                                                    <input type="hidden" name="war" value="{{ $war }}">
                                                    <input type="hidden" name="lost" value="{{ $los }}">
                                            </tr>


                                            {{--      <tr class="hover:bg-grey-lighter">
                                                <td class="py-4 px-6 border-b border-grey-light">
                                                    <button
                                                        class="p-2 my-2 bg-gray-500 text-white rounded-md focus:outline-none focus:ring-2 ring-gray-300 ring-offset-2">Lost</button>

                                                <td class="py-4 px-6 border-b border-grey-light">
                                                    {{ $los }}


                                            </tr>
                                            --}}
                                            <tr class="hover:bg-grey-lighter">
                                                <td class="py-4 px-6 border-b border-grey-light">
                                                    <button
                                                        class="p-2 my-2 bg-green-500 text-white rounded-md focus:outline-none focus:ring-2 ring-green-300 ring-offset-2"
                                                        type="button">Complete</button>

                                                <td class="py-4 px-6 border-b border-grey-light">
                                                    {{ $c_data-($err+$war+$los)  }} / {{ $c_data }}
                                                    <input type="hidden" name="com"
                                                        value="{{ $c_data-($err+$war+$los)  }}">

                                                    <input type="hidden" name="rec_all" value="{{ $c_data }}">

                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>



                            <div class="row">
                                <div class="w-full mx-auto">
                                    <div class="sm:grid grid-cols-4 gap-5 mx-auto px-16">
                                        <div class="col-start-1 col-end-3 my-2">
                                            <a href="{{ url('importpolice') }}">
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
                    <script type="text/javascript">
                        function tableToExcel() {        
                            $(".table2excel").table2excel({
					exclude: ".noExl",
					name: "Excel Document Name",
					filename: "Police data defect",
					fileext: ".xls",
					exclude_img: true,
					exclude_links: true,
					exclude_inputs: true
				});
                           

                        }
                    </script>




                    <div id="hidepage" style="display:none;">
                        <audio autoplay id="bgsound">
                            <source src="{{ asset('storage/sound/eventually.mp3') }}" type="audio/mp3">
                            <source src="{{ asset('storage/sound/eventually.ogg') }}" type="audio/ogg; codecs=vorbis">
                            <p>ขออภัย เว็บเบราว์เซอร์ของคุณไม่รองรับเสียงแจ้งเตือน กรุณาเปิดโปรแกรมบน Google Chrome หรือ
                                MS Edge</p>
                        </audio>
                    </div>

                </div>
            </div>
        </div>
    </div>


</x-app-layout>