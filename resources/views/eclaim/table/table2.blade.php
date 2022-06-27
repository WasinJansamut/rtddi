{{-- <p class="text-lg text-center font-bold m-5">{!! $title !!} | <small class="text-red-600">({{ count($list)}}
รายการ)</small> </p> --}}

<table class="border-collapse w-full ">
    <tr>
        <th></th>
    </tr>
    <tr class="flex w-full">
        <th colspan="6">
            <p class="text-lg text-center font-bold m-5">{!! $title !!} | <small class="text-red-600">({{ count($list)}}
                    รายการ)</small> </p>
        </th>
    </tr>
    <thead class="flex  w-full">
        <tr class="flex w-full">
            <th class="w-1/4 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                # </th>
            <th class="w-1/4 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                เลขประจำตัวประชาชนผู้ประสบเหตุ</th>
            <th class="w-1/4 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                คำนำหน้า</th>
            <th class="w-1/4 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                ชื่อผู้ประสบเหตุ</th>
            <th class="w-1/4 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                นามสกุลผู้ประสบเหตุ</th>
            <th class="w-1/4 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                วันเวลาที่เกิดเหตุ</th>


    </thead>

    <tbody class="flex flex-col items-center justify-between overflow-y-scroll w-full"
        style="{{ count($list)>10 ? "height: 20vh;" : "" }}">

        @foreach($list as $item)
        <tr class="flex w-full">
            <td class="w-full  w-1/4  text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $loop->iteration }}</td>
            <td class="w-full  w-1/4 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $item['เลขประจำตัวประชาชนผู้ประสบเหตุ'] ?? "-" }}</td>
            <td class="w-full  w-1/4 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $item['คำนำหน้าชื่อผู้ประสบเหตุ'] ?? "-" }}</td>
            <td class="w-full  w-1/4 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $item['ชื่อผู้ประสบเหตุ'] ?? "-" }}</td>
            <td class="w-full w-1/4 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $item['นามสกุลผู้ประสบเหตุ'] ?? "" }} </td>
            <td class="w-full  w-1/4  text-gray-800 text-center border border-b block lg:table-cell relative lg:static">

                @php
                $deaddate = $item['วันเวลาที่เกิดเหตุ'];
                $dead_y = (int)substr($deaddate,0,4)-543;
                $dead_m = substr($deaddate,4,2);
                $dead_d = substr($deaddate,6,2);
                @endphp
                {{ $dead_d }} / {{ $dead_m }} /{{ (int)$dead_y ?? "" }}
            </td>
        </tr>
        @endforeach

    </tbody>
</table>