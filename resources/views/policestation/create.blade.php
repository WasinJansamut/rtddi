@section('title','จัดการข้อมูลสถานีตำรวจ')
@section('subtitle',Request::path() )
<x-app-layout>

    <style>
        input.text {
            focus: ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300
        }
    </style>
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">ข้อมูลสถานีตำรวจ</h3>


        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">

                    @if ($errors->any())
                    <div class="px-4 py-3 leading-normal text-white-700 bg-red-100 rounded-lg" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif


                    <!--Card-->




                    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">ข้อมูลสถานีตำรวจ</h3>
                                    <p class="mt-1 text-sm text-gray-600">
                                        Police_stations
                                    </p>
                                    <div class="border-t border-gray-200"></div>
                                </div>
                            </div>

                            {{--  start form --}}

                            @if(isset($policestation))

                            {{ Form::model($policestation, ['route' => ['policestation.update', $policestation->ORG_CODE], 'method' => 'patch']) }}


                            @else
                            {{ Form::open(['route' => 'policestation.store']) }}

                            @endif



                            {{Form::label('ORG_CODE', 'รหัสสถานี', ['class' => 'block text-sm font-medium text-gray-700' ] )}}
                            {{ Form::text('ORG_CODE', request::old('ORG_CODE') ,['class' => 'focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300'] )  }}

                            <br>
                            {{Form::label('ORG', 'ชื่อสถานีตำรวจ', ['class' => 'block text-sm font-medium text-gray-700' ] )}}
                            {{ Form::text('ORG', request::old('ORG') ,['class' => 'focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300'] )  }}
                            <br>
                            {{Form::label('PROV_CODE', 'รหัสจังหวัด', ['class' => 'block text-sm font-medium text-gray-700' ] )}}
                            {{ Form::text('PROV_CODE', request::old('PROV_CODE') ,['class' => 'focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300'] )  }}
                            <br>
                            {{Form::label('PROV_NAME', 'ชื่อจังหวัด', ['class' => 'block text-sm font-medium text-gray-700' ] )}}
                            {{ Form::text('PROV_NAME', request::old('PROV_NAME') ,['class' => 'focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300'] )  }}
                            <br>






                            {{-- 
                            {{ Form::text('ORG', request::old('ORG')) }}
                            {{ Form::text('PROV_CODE', request::old('PROV_CODE')) }}
                            {{ Form::text('PROV_NAME', request::old('PROV_NAME'))}} --}}
                            {{-- More fields... 
                            {{ Form::submit('Save', ['name' => 'submit'],['class' => '']) }}
                            {{ Form::close() }}
                            --}}





                            {{Form::submit('บันทึก', ['class' => 'inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500'],[ 'onclick' => "return confirm('Are you sure ?');"])}}

                            <a href="{{ url('policestation')}}"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">ย้อนกลับ</a>



                            {{ Form::close() }}

                            {{--  end form --}}

                        </div>


                        <div class="hidden sm:block" aria-hidden="true">
                            <div class="py-5">
                                <div class="border-t border-gray-200"></div>
                            </div>
                        </div>





                    </div>
                    <!--/Card-->
                </div>


            </div>
        </div>


    </div>


</x-app-layout>