* แสดงข้อมูล {{ $show_rows }} Records.
<table class="border-collapse w-full">
    <thead>
        <tr>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
            </th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                เลขประจำตัวประชาชนผู้ประสบเหตุ</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                ตัวย่อชื่อจังหวัดรถเกิดเหตุ</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                หมวดทะเบียนรถเกิดเหตุ</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                ประเภทรถเกิดเหตุ</th>

            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                คำนำหน้าชื่อผู้ประสบเหตุ</th>

            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                ชื่อผู้ประสบเหตุ</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                นามสกุลผู้ประสบเหตุ <small></small></th>

            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                เพศผู้ประสบเหตุ</th>

            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                สัญชาติผู้ประสบเหตุ</th>

            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                วันเดือนปีเกิดผู้ประสบเหตุ</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                อายุผู้ประสบเหตุ</th>


            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                วันเวลาที่เกิดเหตุ</th>

            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                ตำบลที่เกิดเหตุ</th>

            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                อำเภอที่เกิดเหตุ</th>

            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                จังหวัดทีเกิดเหตุ</th>

            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                พิกัด Latitude ที่เกิดเหตุ</th>

            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                พิกัด Longitude ที่เกิดเหตุ</th>

            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                อาชีพผู้ประสบเหตุ</th>

            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                อำเภอที่อยู่</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                จังหวัดที่อยู่</th>

            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                ยี่ห้อยานพาหนะเกิดเหตุ</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                รหัสโรงพยาบาลที่รักษาผู้ประสบเหตุ</th>

            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                สถานะบาดเจ็บผู้ประสบเหตุ </th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                ประเภทผู้ใช้รถใช้ถนน</th>
        </tr>
    </thead>
    <tbody>



        @forelse ($data[0]->take($show_rows) as $row)

        <tr
            class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $no++ }}
            </td>
            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">

                {{ $row['เลขประจำตัวประชาชนผู้ประสบเหตุ'] ?? ''}}


            </td>
            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['ตัวย่อชื่อจังหวัดรถเกิดเหตุ'] ?? ''}}
            </td>

            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['หมวดทะเบียนรถเกิดเหตุ'] ?? ''}}


            </td>

            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['ประเภทรถเกิดเหตุ'] ?? ''}}


            </td>

            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['คำนำหน้าชื่อผู้ประสบเหตุ'] ?? ''}}


            </td>

            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['ชื่อผู้ประสบเหตุ'] ?? ''}}


            </td>

            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['นามสกุลผู้ประสบเหตุ'] ?? ''}}
            </td>

            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['เพศผู้ประสบเหตุ'] ?? ''}}
            </td>

            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['สัญชาติผู้ประสบเหตุ'] ?? ''}}
            </td>

            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['วันเดือนปีเกิดผู้ประสบเหตุ'] ?? ''}}
            </td>


            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['อายุผู้ประสบเหตุ'] ?? ''}}
            </td>

            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['วันเวลาที่เกิดเหตุ'] ?? ''}}
            </td>

            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['ตำบลที่เกิดเหตุ'] ?? ''}}
            </td>


            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['อำเภอที่เกิดเหตุ'] ?? ''}}
            </td>

            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['จังหวัดทีเกิดเหตุ'] ?? ''}}

            </td>



            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['พิกัด Latitude ที่เกิดเหตุ'] ?? ''}}
            </td>

            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['พิกัด Longitude ที่เกิดเหตุ'] ?? ''}}
            </td>


            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['อาชีพผู้ประสบเหตุ'] ?? ''}}
            </td>


            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['อำเภอที่อยู่'] ?? ''}}
            </td>

            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['จังหวัดที่อยู่'] ?? ''}}
            </td>


            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['ยี่ห้อยานพาหนะเกิดเหตุ'] ?? ''}}
            </td>


            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['รหัสโรงพยาบาลที่รักษาผู้ประสบเหตุ'] ?? ''}}
            </td>

            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['สถานะบาดเจ็บผู้ประสบเหตุ'] ?? ''}}
            </td>

            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['ประเภทผู้ใช้รถใช้ถนน'] ?? ''}}
            </td>

        </tr>
        @empty
        <tr class="text-center">
            <td colspan="19">--ไม่มีข้อมูล--</td>
        </tr>
        @endforelse


    </tbody>
</table>