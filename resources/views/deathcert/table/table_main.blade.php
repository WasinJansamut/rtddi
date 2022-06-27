* แสดงข้อมูล {{ $show_rows }} Records.
<table class="border-collapse w-full">
    <thead>
        <tr>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
            </th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                เลขบัตรประชาชน</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                ชื่อ</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                สกุล</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                เพศ</th>

            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                อายุ</th>

            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                สัญชาติ</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                อาชีพ <small></small></th>

            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                รหัสที่อยู่ตามทะเบียนบ้าน </th>

            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                วันที่เสียชีวิต</th>

            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                เดือนที่เสียชีวิต</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                ปีที่เสียชีวิต</th>


            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                รหัสจังหวัดที่เสียชีวิต</th>

            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                รหัสอำเภอที่เสียชีวิต</th>

            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                วันที่เกิด</th>

            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                เดือนที่เกิด</th>

            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                ปีที่เกิด</th>

            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                รหัส รพ ที่เสียชีวิต</th>

            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                รหัสสาเหตุการเสียชีวิต(ICD-10)</th>
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

                {{ $row['เลขบัตรประชาชน'] ?? ''}}


            </td>
            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['ชื่อ'] ?? ''}}
            </td>

            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['สกุล'] ?? ''}}


            </td>

            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['เพศ'] ?? ''}}


            </td>

            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['อายุ'] ?? ''}}


            </td>

            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['สัญชาติ'] ?? ''}}


            </td>

            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['อาชีพ'] ?? ''}}
            </td>

            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['รหัสที่อยู่ตามทะเบียนบ้าน'] ?? ''}}
            </td>

            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['วันที่เสียชีวิต'] ?? ''}}
            </td>

            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['เดือนที่เสียชีวิต'] ?? ''}}
            </td>


            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['ปีที่เสียชีวิต'] ?? ''}}
            </td>

            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['รหัสจังหวัดที่เสียชีวิต'] ?? ''}}
            </td>

            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['รหัสอำเภอที่เสียชีวิต'] ?? ''}}
            </td>


            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['วันที่เกิด'] ?? ''}}
            </td>

            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['เดือนที่เกิด'] ?? ''}}

            </td>



            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['ปีที่เกิด'] ?? ''}}
            </td>

            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['รหัส รพ ที่เสียชีวิต'] ?? ''}}
            </td>


            <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $row['รหัสสาเหตุการเสียชีวิต(ICD-10)'] ?? ''}}
            </td>

        </tr>
        @empty
        <tr class="text-center">
            <td colspan="19">--ไม่มีข้อมูล--</td>
        </tr>
        @endforelse


    </tbody>
</table>