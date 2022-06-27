@section('title','หน้าหลัก')
@section('subtitle',Request::path() )
<x-app-layout>
    <div class="container mx-auto px-6 py-8">

        <meta http-equiv="refresh" content="300" />


        {{--    <h3 class="text-gray-700 text-3xl font-medium">Dashboard</h3>
 --}}


        {{-- start loadpage --}}
        <div id="hidepage2" style="display:block;" align="center" width="100%">
            <br>
            <IMG SRC="{{ asset('storage/loading.gif') }}" WIDTH="100" HEIGHT="100" BORDER="0" ALT=""><br>
            กรุณารอสักครู่...
        </div>

        <div id="hidepage" style="display:none;">
        </div>
        {{-- end loadpage --}}

        @if(session('success'))<div class="py-3 px-2 my-2 bg-green-300 text-green-800 rounded border border-green-600">
            {{session('success')}}</div>
        @endif
        {{-- 

        
        {{--   Lastdata --}}
        <div class="space-x-2 bg-blue-50 p-4 rounded flex items-start text-blue-600 my-4 shadow-lg mx-auto max-w-2xl">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-5 pt-1" viewBox="0 0 24 24">
                    <path
                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.5 5h3l-1 10h-1l-1-10zm1.5 14.25c-.69 0-1.25-.56-1.25-1.25s.56-1.25 1.25-1.25 1.25.56 1.25 1.25-.56 1.25-1.25 1.25z" />
                </svg>
            </div>
            <h3 class="text-blue-800 tracking-wider flex-1">
                ข้อมูลผู้เสียชีวิตล่าสุดในฐานข้อมูลคือ
                @php //
                $lastdata = App\Models\Integration_final::latest('DeadDate_en')->first();
                //echo $lastdata['DeadDate_en'] ;
                @endphp
                {{ Carbon\Carbon::parse($lastdata['DeadDate_en'])->addYear(543)->format('d/m/Y') }}
            </h3>
            <div class="inline-flex items-center space-x-2">


            </div>
        </div>
        {{--  End Lastdata --}}



        <div class="flex flex-wrap -mx-6">
            <div class="w-full px-6">
                <h4 class="text-gray-700 text-3xl font-medium ">ข้อมูลบูรณาการรายปี</h4>
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                    google.charts.load("current", {packages:['corechart']});
                  google.charts.setOnLoadCallback(drawChart);
                  function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                      ['ปี', 'จำนวนผู้เสียชีวิต',{ role: 'annotation'}],
                      @foreach ($count_y as $c_year)
                      ['{{ $c_year->year_dead+543  }}', {{ $c_year->c_y }} , {{ $c_year->c_y }}],
                        @endforeach
                    ]);
                    
                    var options = {
                      title: "",
                      width: '100%',    
                      height: '400',
                      bar: {groupWidth: '95%'},
                      legend: { position: 'none' },
                      max:20000,
              min:0,
                    };
                    var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_plain'));
                    chart.draw(data, options);

                    
                }
                </script>
                <div id="columnchart_plain"></div>
            </div>

            <div class="mt-8">

            </div>

            <div class="w-full px-8 mt-8">
                <h4 class="text-gray-700 text-3xl font-medium ">ข้อมูลบูรณาการ รายเดือน ( ปี
                    {{ $c_year->year_dead+543  }}
                    )
                </h4>
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                    google.charts.load("current", {packages:['corechart']});
                  google.charts.setOnLoadCallback(drawChart);
                  function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                      ['เดือน', 'จำนวนผู้เสียชีวิต',{ role: 'annotation'}],
                      @foreach ($count_m as $c_month)
                      ['@php
                    if ($c_month->month_dead=='01') {echo 'ม.ค.';}
    elseif ($c_month->month_dead=='02') {echo 'ก.พ.';}
    elseif ($c_month->month_dead=='03') {echo 'มี.ค.';}
    elseif ($c_month->month_dead=='04') {echo 'เม.ย.';}
    elseif ($c_month->month_dead=='05') {echo 'พ.ค.';}
    elseif ($c_month->month_dead=='06') {echo 'มิ.ย.';}
    elseif ($c_month->month_dead=='07') {echo 'ก.ค.';}
    elseif ($c_month->month_dead=='08') {echo 'ส.ค.';}
    elseif ($c_month->month_dead=='09') {echo 'ก.ย.';}
    elseif ($c_month->month_dead=='10') {echo 'ต.ค.';}
    elseif ($c_month->month_dead=='11') {echo 'พ.ย.';}
    elseif ($c_month->month_dead=='12') {echo 'ธ.ค.';}
                @endphp', {{ $c_month->c_m }} , {{ $c_month->c_m }}],
                        @endforeach
                    ]);
                    var options = {
                      title: "",
                      width: '100%',
                        height: '400',
                        max:2000,
              min:0,
                      bar: {groupWidth: '95%'},
                      legend: { position: 'none' },
                    };
                    var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_plain2'));
                    chart.draw(data, options);
                }
                </script>
                <div id="columnchart_plain2"></div>
            </div>
        </div>



        <div class="mt-8">

        </div>

        <div class="flex flex-col mt-8">
            <h4 class="text-gray-700 text-3xl font-medium ">Data Flow</h4>
            <img src="{{ asset('storage/flow.jpg') }}" width="100%" />
        </div>


        <div class="mt-8">

        </div>







        <div class="flex flex-col mt-8">
            <div class="relative h-16 w-100">
                <h4 class="text-gray-700 text-3xl font-medium">ประวัติการใช้งาน <small>(10 รายการล่าสุด)</small></h4>
                <div class="absolute top-0 right-0 h-16 w-100 ">
                    <a href="{{ url('logs') }}">
                        ดูทั้งหมด</a>

                </div>
            </div>



            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                    <table class="min-w-full">
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
                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                                    {{ $row->action  ?? '-' }}
                                </td>
                            </tr>

                            @empty

                            @endforelse


                        </tbody>
                    </table>
                </div>
            </div>
        </div>





    </div>

</x-app-layout>