{{-- <div class="tab w-full overflow-hidden border-t">
    <input class="absolute opacity-0 " id="{{  $title }}" type="checkbox" name="tabs">
<label class="block p-5 leading-normal cursor-pointer" for="{{  $title }}">
    {!! $title !!} | <small class="text-red-600">({{ count($list)}}
        รายการ)</small>
</label>
<div class="tab-content overflow-hidden border-l-2 bg-gray-100 border-indigo-500 leading-normal">
    {{-- content --}}
    <table class="border-collapse w-full ">
        <tr>
            <th></th>
        </tr>
        <tr class="flex w-full">
            <th colspan="7">
                <p class="text-lg text-center font-bold m-5">{!! $title !!} | <small
                        class="text-red-600">({{ count($list)}}
                        รายการ)</small> </p>
            </th>
        </tr>
        <thead class="flex  w-full">
            <tr class="flex w-full">
                <th
                    class="w-1/4 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                    # </th>
                <th
                    class="w-1/4 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                    เลขบัตรประชาชน</th>
                <th
                    class="w-1/4 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                    ชื่อ</th>
                <th
                    class="w-1/4 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                    สกุล</th>
                <th
                    class="w-1/4 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                    วันที่เสียชีวิต</th>
                <th
                    class="w-1/4 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                    เดือนที่เสียชีวิต</th>
                <th
                    class="w-1/4 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                    วันที่เสียชีวิต</th>


        </thead>

        <tbody class="flex flex-col items-center justify-between overflow-y-scroll w-full"
            style="{{ count($list)>10 ? "height: 20vh;" : "" }}">

            @foreach($list as $item)
            <tr class="flex w-full">
                <td
                    class="w-full  w-1/4  text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                    {{ $loop->iteration }}</td>
                <td
                    class="w-full  w-1/4  text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                    {{ $item['เลขบัตรประชาชน'] ?? "-" }}</td>
                <td
                    class="w-full  w-1/4  text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                    {{ $item['ชื่อ'] ?? "-" }}</td>
                <td
                    class="w-full  w-1/4  text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                    {{ $item['สกุล'] ?? "" }} </td>
                <td
                    class="w-full  w-1/4  text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                    {{ $item['วันที่เสียชีวิต'] ?? "" }} </td>
                <td
                    class="w-full  w-1/4  text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                    {{ $item['เดือนที่เสียชีวิต'] ?? "" }} </td>
                <td
                    class="w-full  w-1/4  text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                    {{ $item['ปีที่เสียชีวิต'] ?? "" }} </td>
            </tr>
            @endforeach

        </tbody>
    </table>

    {{--     </div>
</div> --}}