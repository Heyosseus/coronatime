<x-dashboard-layout>
    <div class="p-6">
        <h1 class="font-extrabold text-xl lg:text-3xl ">@lang('home.statistics')</h1>
        <div class="flex space-x-6 mt-5 lg:mt-10
        ">
            <a href="{{route('home')}}" class="lg:text-xl">@lang('home.worldwide')</a>
            <a href="#" class="font-bold relative lg:text-xl"> @lang('home.by_country')
                <div class="absolute bg-gray-950 mt-3 ml-1 h-1 w-20 lg:w-24"></div>
            </a>
        </div>
        <div class="">
            <form action="#" method="GET"
                  class=" h-14 rounded-xl py-2 lg:px-6 lg:border lg:border-gray-300 outline-none bg-white flex items-center  mt-10 lg:w-80 ">
                <img src="/public/assets/search.png" alt="" class="w-6 h-6">
                <input type="text" class="ml-4 outline-0 border-0" name="search" placeholder="@lang('home.search')">
            </form>
        </div>
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
    @php
        $newSortDirection = ($sortDirection === 'asc') ? 'desc' : 'asc';
    @endphp
    <div>
        <div class="overflow-y-auto max-h-[55vh] w-fit scrollbar-thumb-[#808189] scrollbar-track-gray-200 scrollbar ">
            <table class="table w-full bg-gray-50 px-4 text-sm h-full lg:mx-auto lg:ml-6 lg:text-lg lg:w-[1240px]">
                <thead>
                <tr class="bg-gray-100 ">
                    <th class="w-1/4 px-2 py-2 text-left lg:py-4 lg:px-3 ">
                        <div class="flex items-center "  x-data="{activeTab: 0}">
                            <p>Location</p>
                            <form  method="GET" x-ref="form">
                                <input type="hidden" name="sort_by" value="location->en">
                                <button type="submit" name="sort_order" value="{{$newSortDirection}}" >
                                    <img src="/storage/up.png" alt="" class="ml-2 w-2 h-2 "  @click="activeTab = 0" :class="{'active' : activeTab === 0 }">
                                    <img src="/storage/down.png" alt="" class="ml-2 mt-0.5 w-2 h-2" @click="activeTab = 1" :class="{'active' : activeTab === 1 }" >
                                </button>
                            </form>

                        </div>

                    </th>

                    <th class="w-1/3 px-4 py-2 text-left">
                        <div class="flex items-center">
                            <p>New Cases</p>
                            <form action="" method="GET">
                                <input type="hidden" name="sort_by" value="new_cases">
                                <button type="submit" name="sort_order" value="{{$newSortDirection}}">
                                    <img src="/storage/up.png" alt="" class="ml-2 w-2 h-2" >
                                    <img src="/storage/down.png" alt="" class="ml-2 mt-0.5 w-2 h-2">
                                </button>
                            </form>
                        </div>
                    </th>
                    <th class="w-1/4 px-4 py-2 text-left">
                        <div class="flex items-center">
                            <p>Deaths</p>
                            <form action="" method="GET">
                                <input type="hidden" name="sort_by" value="deaths">
                                <button type="submit" name="sort_order" value="{{$newSortDirection}}">
                                    <img src="/storage/up.png" alt="" class="ml-2 w-2 h-2" >
                                    <img src="/storage/down.png" alt="" class="ml-2 mt-0.5 w-2 h-2">
                                </button>
                            </form>
                        </div>
                    </th>
                    <th class="w-1/4 px-4 py-2 text-left ">
                        <div class="flex items-center">
                            <p>Recovered</p>
                            <form action="" method="GET">
                                <input type="hidden" name="sort_by" value="recovered">
                                <button type="submit" name="sort_order" value="{{$newSortDirection}}">
                                    <img src="/storage/up.png" alt="" class="ml-2 w-2 h-2" >
                                    <img src="/storage/down.png" alt="" class="ml-2 mt-0.5 w-2 h-2">
                                </button>
                            </form>
                        </div>
                    </th>
                </tr>

                </thead>
                <tbody class="bg-white">
                <tr class="border border-bottom ">
                    <td class=" border-b-gray-100 px-3 py-4">@lang('home.worldwide')</td>
                    <td class=" border-b-gray-100 px-3 py-4">{{ $worldwideNewCases }}</td>
                    <td class=" border-b-gray-100 px-3 py-4">{{ $worldwideDeaths }}</td>
                    <td class=" border-b-gray-100 px-3 py-4">{{ $worldwideRecovered }}</td>

                </tr>
                @foreach ($countries as $country)
                    <tr class="border border-bottom ">
                        <td class=" border-b-gray-100 px-3 py-4">
                            @if(app()->getLocale() == 'en')
                                {{ $locations[$country->code]['en'] }}
                            @else
                                {{ $locations[$country->code]['ka'] }}
                            @endif</td>

                        <td class=" border-b-gray-100 px-4 py-4">{{ $country['new_cases'] }}</td>
                        <td class=" border-b-gray-100 px-4 py-4">{{ $country['deaths'] }}</td>
                        <td class=" border-b-gray-100 px-4 py-4">{{ $country['recovered'] }}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-layout>


