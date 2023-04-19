<x-dashboard-layout>
        <div class="p-6">
            <h1 class="font-extrabold text-xl lg:text-3xl">@lang('home.statistics')</h1>
            <div class="flex space-x-6 mt-5 lg:mt-10">
                <a href="#" class="font-bold relative lg:text-xl"> @lang('home.worldwide')
                    <div class="absolute bg-gray-950 mt-3 ml-1 h-1 w-20"></div>
                </a>

                <a href="#" class="lg:text-xl">@lang('home.by_country')</a>
            </div>
            <div class="lg:flex lg:justify-between lg:w-cards lg:space-x-6">
                <x-colored-card colors="bg-blue">
                    <div class="flex flex-col justify-center items-center text-xl p-6 lg:w-form lg:p-8 ">
                        <img src="/storage/chart.png" alt="" width="120">
                        <h1 class="mt-4 font-bold">@lang('home.new_cases')</h1>
                        <p class="text-text-blue font-bold lg:text-3xl mt-6">715,523</p>
                    </div>
                </x-colored-card>

                <div class="flex space-x-4 w-full lg:space-x-6">
                    <x-colored-card colors="bg-green">
                        <div class="flex flex-col justify-center items-center w-28 text-xl lg:w-form lg:p-8">
                            <img src="/storage/chart-2.png" alt="" width="100">
                            <div class="mt-5">
                                <h1 class="mt-5 font-bold">@lang('home.recovered')</h1>
                                <div class="text-text-green text-center font-bold lg:text-3xl mt-3">82,332</div>
                            </div>
                        </div>
                    </x-colored-card>

                    <x-colored-card colors="bg-yellow">
                        <div class="flex flex-col justify-center items-center w-28 text-xl p-6 lg:w-form lg:p-8">
                            <img src="/storage/chart-3.png" alt="">
                            <div class="mt-4">
                                <h1 class="mt-4 font-bold">@lang('home.death')</h1>
                                <p class="text-text-yellow font-bold lg:text-3xl mt-2">8,332</p>
                            </div>
                        </div>
                    </x-colored-card>
                </div>
            </div>

            <div class="hidden lg:block lg:mr-4 bg-gradient-blue rounded-xl">
                <x-colored-card colors="gradient-blue">
                    <div class="py-4">
                        <h1 class="text-2xl font-bold text-center mt-2 lg:text-3xl">@lang('home.notify')</h1>
                        <p class="text-center mt-4 text-lg ">Get <span class="font-bold">personalised </span> notifications
                            via email</p>
                        <form action=""
                              class="w-form h-14 rounded-full border-0 outline-none px-4 bg-white flex justify-center items-center mx-auto mt-10 mb-4 ">
                            <img src="/storage/search.png" alt="" class="w-5 h-5 ">
                            <input type="text" class="ml-2 outline-0 border-0" placeholder="Enter your email">
                            <button class="bg-[#0FBA68] text-white rounded-3xl h-10 w-20 ml-2 uppercase font-bold text-sm ">
                                @lang('home.send')
                            </button>
                        </form>
                    </div>
                </x-colored-card>
            </div>
        </div>
</x-dashboard-layout>
