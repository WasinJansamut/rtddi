{{-- <p class="text-lg text-center font-bold m-5">{!! $title !!} | <small class="text-red-600">({{ count($list)}}
รายการ)</small> </p> --}}

<table class="border-collapse w-full ">
    <tr>
        <th></th>
    </tr>
    <tr class="flex w-full">
        <th colspan="8">
            <p class="text-lg text-center font-bold m-5">{!! $title !!} | <small class="text-red-600">({{ count($list)}}
                    รายการ)</small> </p>
        </th>
    </tr>
    <thead class="flex  w-full">
        <tr class="flex w-full">
            <th class="w-1/4 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                # </th>
            <th class="w-1/4 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                เลขบัตรประชาชน</th>
            <th class="w-1/4 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                คำนำหน้า</th>
            <th class="w-1/4 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                ชื่อ</th>
            <th class="w-1/4 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                สกุล</th>
            <th class="w-1/4 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                อายุ (Raw)</th>
            <th class="w-1/4 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                วันที่เกิด</th>

            <th class="w-1/4 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                วันที่เสียชีวิต</th>



    </thead>

    <tbody class="flex flex-col items-center justify-between overflow-y-scroll w-full"
        style="{{ count($list)>10 ? "height: 20vh;" : "" }}">


        @foreach($list as $item)
        <tr class="flex w-full">
            <td class="w-full  w-1/4  text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $loop->iteration }}</td>
            <td class="w-full  w-1/4  text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $item['CARD_ID'] ?? "-" }}</td>
            <td class="w-full  w-1/4 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $item['TITLE'] ?? "-" }} </td>
            <td class="w-full  w-1/4  text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $item['FIRST_NAME'] ?? "-" }}</td>
            <td class="w-full  w-1/4  text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $item['LAST_NAME'] ?? "" }} </td>
            <td class="w-full  w-1/4  text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $item['AGE'] ?? "" }} </td>

            <td class="w-full  w-1/4  text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                @if ( empty($item['BIRTH_DATE']))
                -
                @else
                {{substr($item['BIRTH_DATE'],6,2)}} / {{substr($item['BIRTH_DATE'],4,2)}}
                /{{ (int)substr($item['BIRTH_DATE'],0,4) ?? "" }}
                @endif


            </td>
            <td class="w-full  w-1/4  text-gray-800 text-center border border-b block lg:table-cell relative lg:static">

                {{substr($item['CGT_ACCIDE_ATDATE'],6,2)}} / {{substr($item['CGT_ACCIDE_ATDATE'],4,2)}}
                /{{ (int)substr($item['CGT_ACCIDE_ATDATE'],0,4) ?? "" }}
            </td>
        </tr>
        @endforeach

    </tbody>
</table>