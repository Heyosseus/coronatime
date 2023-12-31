<x-dashboard-layout>
        <div class="p-6">
            <h1 class="font-extrabold text-xl lg:text-3xl">@lang('home.statistics')</h1>
            <div class="flex space-x-6 mt-5 lg:mt-10">
                <a href="#" class="font-bold relative lg:text-xl"> @lang('home.worldwide')
                    <div class="absolute bg-gray-950 mt-3 ml-1 h-1 w-20"></div>
                </a>

                <a href="{{route('countries')}}" class="lg:text-xl">@lang('home.by_country')</a>
            </div>
            @php
                $worldwideNewCases = 0;
                 $worldwideDeaths = 0;
                 $worldwideRecovered = 0;


            @endphp
            @foreach($countries as $country)
                @php
                    $worldwideNewCases += $country['new_cases'];
                    $worldwideDeaths += $country['deaths'];
                    $worldwideRecovered += $country['recovered'];

                @endphp
            @endforeach
            <div class="lg:flex lg:items-center lg:justify-center ">
            <div class="lg:flex lg:justify-between  lg:space-x-6  lg:items-center l">

                <div class="mt-10 p-8 bg-blue_bg rounded-2xl shadow ">
                    <div class="flex flex-col justify-center items-center text-xl p-6 lg:w-form lg:p-8 ">
                        <img src="{{asset('assets/chart.png')}}" alt="" width="120">
                        <h1 class="mt-4 font-bold text-center text-sm lg:text-xl">@lang('home.new_cases')</h1>
                        <p class="text-text-blue font-bold mt-2 lg:text-3xl lg:mt-5">{{number_format($worldwideNewCases)}}</p>
                    </div>
                </div>


                <div class="flex space-x-4 w-full lg:space-x-6 lg:items-center">
                    <div class="mt-10 p-9 bg-green_bg rounded-2xl shadow ">
                        <div class="flex flex-col justify-center items-center w-28 text-xl lg:w-form lg:p-8">
                            <img src="{{asset('assets/chart-2.png')}}" alt="" width="100">
                            <div class="mt-5">
                                <h1 class="mt-5 font-bold text-center text-sm lg:text-xl">@lang('home.recovered')</h1>
                                <div class="text-text-green text-center font-bold lg:text-3xl mt-3">{{number_format($worldwideRecovered)}}</div>
                            </div>
                        </div>
                        </div>

                    <div class="mt-10 p-10 bg-yellow_bg rounded-2xl shadow ">
                        <div class="flex flex-col justify-center items-center w-28 text-xl p-6 lg:w-form lg:p-8">
                            <img src="{{asset('assets/chart-3.png')}}" alt="">
                            <div class="mt-4">
                                <h1 class="lg:mt-6  mt-4 font-bold text-center text-sm lg:text-xl">@lang('home.death')</h1>
                                <p class="text-text-yellow font-bold mt-2 lg:text-3xl lg:mt-3">{{number_format($worldwideDeaths)}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        </div>
    <div class="hidden lg:block  bg-gradient-blue lg:fixed lg:bottom-0 lg:w-full">
        <x-colored-card color="gradient-blue">
            <div class="py-5">
                <h1 class="text-2xl font-bold text-center mt-2 lg:text-3xl">@lang('home.notify')</h1>
                <p class="text-center mt-4 text-lg ">
                    @lang('home.personalised')</p>
                <form action=""
                      class="w-form h-14 rounded-full border-0 outline-none px-4 bg-white flex justify-center items-center mx-auto mt-10 mb-4 ">
                    <img src="{{asset('assets/search.png')}}" alt="" class="w-5 h-5 ">
                    <input type="text" class="ml-2 outline-0 border-0" placeholder="@lang('register.enter_email')">
                    <button class="bg-[#0FBA68] text-white rounded-3xl h-10 w-20 ml-2 uppercase font-bold text-sm ">
                        @lang('home.send')
                    </button>
                </form>
            </div>
        </x-colored-card>
    </div>
</x-dashboard-layout>


