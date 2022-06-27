{{-- <p class="text-lg text-center font-bold m-5"> {!! $title !!} | <small class="text-red-600">({{ count($list)}}
รายการ)</small> </p> --}}
{{-- <li class="flex align-center flex-col">
    <h4 @click="selected !== {{$j}} ? selected = {{$j}} : selected = null"
class="cursor-pointer px-5 py-3 bg-indigo-300 text-white text-center inline-block hover:opacity-75 hover:shadow
hover:-mb-3 rounded-t">
{{ $j }} {!! $title !!} | <small class="text-red-600">({{ count($list)}} รายการ)</small></h4>
<div x-show="selected == {{$j}}" :class="{'border py-4 px-2': true, 'rounded-b': selected == {{$j}}}">
    --}}
    <table class="border-collapse w-full ">
        <tr>
            <th></th>
        </tr>
        <tr class="flex w-full">
            <th colspan="4">
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

        </thead>

        <tbody class="flex flex-col items-center justify-between overflow-y-scroll w-full"
            style="{{ count($list)>10 ? "height: 20vh;" : "" }}">
            @foreach($list as $item)
            <tr class="flex w-full">
                <td
                    class="w-full  w-1/4  text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                    {{ $loop->iteration }}

                </td>
                <td
                    class="w-full  w-1/4  text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                    {{ $item['เลขบัตรประชาชน'] ?? "-" }}</td>
                <td
                    class="w-full  w-1/4  text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                    {{ $item['ชื่อ'] ?? "-" }}</td>
                <td
                    class="w-full  w-1/4  text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                    {{ $item['สกุล'] ?? "" }} </td>
            </tr>
            @endforeach

        </tbody>
    </table>

    {{-- 
    </div>
</li> --}}