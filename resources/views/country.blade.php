<x-dashboard-layout>
    <div class="p-6">
        <h1 class="font-extrabold text-xl lg:text-3xl lg:px-16">@lang('home.statistics')</h1>
        <div class="flex space-x-6 mt-5 lg:mt-10 lg:px-16"
        ">
        <a href="{{route('home')}}" class="lg:text-xl">@lang('home.worldwide')</a>
        <a href="#" class="font-bold relative lg:text-xl"> @lang('home.by_country')
            <div class="absolute bg-gray-950 mt-3 ml-1 h-1 w-20 lg:w-24"></div>
        </a>
    </div>
    <div class="lg:px-16">
        <form action=""
              class=" h-14 rounded-xl py-2 lg:px-6 lg:border lg:border-gray-300 outline-none bg-white flex items-center  mt-10 lg:w-80 ">
            <img src="/storage/search.png" alt="" class="w-6 h-6">
            <input type="text" class="ml-4 outline-0 border-0" placeholder="Search by country">
        </form>
    </div>
    </div>
    @php
        $worldwideRecovered = 0;
        $worldwideDeaths = 0;
        $worldwideNewCases = 0;
    @endphp
    @foreach($countries as $country)
        @php
            $worldwideRecovered += $country['recovered'];
            $worldwideDeaths += $country['deaths'];
            $worldwideNewCases += $country['new_cases'];
        @endphp
    @endforeach
    <div>
        <table class="table-fixed bg-gray-50 px-4 text-sm h-full lg:mx-auto lg:ml-20 lg:mt-10 lg:text-lg lg:w-[1240px]">
            <thead>
            <tr class="bg-gray-100 ">
                <th class="w-1/4 px-2 py-2 text-left lg:py-4 lg:px-3 ">
                    <div class="flex items-center">
                        <p>Location</p>
                        <div class="ml-2">
                            <img src="/storage/up.png" alt="" class="">
                            <img src="/storage/down.png" alt="" class="mt-0.5">
                        </div>
                    </div>

                </th>

                <th class="w-1/3 px-4 py-2 text-left">
                    <div class="flex items-center">
                        <p>New Cases</p>
                        <div class="ml-2">
                            <img src="/storage/up.png" alt="">
                            <img src="/storage/down.png" alt="" class="mt-0.5">
                        </div>
                    </div>
                </th>
                <th class="w-1/4 px-4 py-2 text-left">
                    <div class="flex items-center">
                        <p>Deaths</p>
                        <div class="ml-2">
                            <img src="/storage/up.png" alt="">
                            <img src="/storage/down.png" alt="" class="mt-0.5">
                        </div>
                    </div>
                </th>
                <th class="w-1/4 px-4 py-2 text-left ">
                    <div class="flex items-center">
                        <p>Recovered</p>
                        <div class="ml-2">
                            <img src="/storage/up.png" alt="">
                            <img src="/storage/down.png" alt="" class="mt-0.5">
                        </div>
                    </div>
                </th>
            </tr>

            </thead>
            <tbody class="bg-white">
            <tr class="border border-bottom ">
                <td class=" border-b-gray-100 px-3 py-4">Worldwide</td>
                <td class=" border-b-gray-100 px-3 py-4">{{ $worldwideRecovered }}</td>
                <td class=" border-b-gray-100 px-3 py-4">{{ $worldwideDeaths }}</td>
                <td class=" border-b-gray-100 px-3 py-4">{{ $worldwideNewCases }}</td>
            </tr>
            @foreach ($countries as $country)
                <tr class="border border-bottom ">
                    <td class=" border-b-gray-100 px-3 py-4">{{ $country['location'] }}</td>
                    <td class=" border-b-gray-100 px-4 py-4">{{ $country['new_cases'] }}</td>
                    <td class=" border-b-gray-100 px-4 py-4">{{ $country['deaths'] }}</td>
                    <td class=" border-b-gray-100 px-4 py-4">{{ $country['recovered'] }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</x-dashboard-layout>


