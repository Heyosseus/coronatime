<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coronatime</title>

    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</head>


<body>

<header>
    <div class="flex justify-between items-center p-6 ">
        <img src="{{asset('assets/logo.png')}}" alt="logo" class="lg:w-56">
        <div class="flex justify-between items-center lg:text-lg">
            <div class="flex items-center justify-center space-x-3 w-25 mr-9">
                <div x-data="{ open: false }">
                    <div class="relative mr-9">

                        <button x-on:click="open = !open" class="text-black py-2 rounded ">
                            <div class="flex items-center justify-center space-x-2">
                                <p>{{ Config::get('languages')[App::getLocale()] }}</p>
                                <img src="/public/assets/arrow.png" alt="" class="w-3 h-2">
                            </div>

                        </button>
                        <div x-show="open" class="absolute bg-gray-100 border border-gray-200 mt-2 py-2 rounded w-28 ">
                            <template x-for="(language, code) in {{ json_encode(Config::get('languages')) }}"
                                      :key="code">
                                <a :href="`{{ route('lang.switch', '') }}/${code}`"
                                   class="block px-4 py-2 text-gray-800 text-sm " x-text="language"
                                   :class="{ 'bg-blue-300': code === '{{ App::getLocale() }}', 'text-white': code === '{{ App::getLocale() }}' }"></a>
                            </template>
                        </div>
                    </div>
                </div>

            </div>


            <div x-data="{ show: false }">

                <button @click="show = !show" class="block lg:hidden mt-0.5">
                    <img src="{{asset('assets/menu-icon.png')}}" alt="" class="cursor-pointer">
                </button>

                <div x-show="show">
                    @if (auth()->check())

                        <p class="fixed right-5  bg-gray-300 py-2 mt-1 px-16 rounded uppercase font-bold text-center">{{ auth()->user()->name }}</p>
                        <form action="{{ route('logout') }}" method="POST"
                              class="fixed right-1 py-2  px-16 mt-10 rounded font-bold">
                            @csrf
                            <button type="submit" class="uppercase text-center">@lang('login.logout')</button>
                        </form>

                    @else
                        <a href="{{route('login')}}"
                           class="fixed right-5 py-2 bg-gray-300 px-16 mt-4 rounded uppercase font-bold">@lang('login.login')</a>
                    @endif
                </div>
                <div class="hidden lg:block">
                    @if (auth()->check())
                        <div class="flex space-x-6">
                            <div class="font-bold">{{auth()->user()->name}}</div>
                            <div class="w-0.5 h-6 bg-gray-400 "></div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit">@lang('login.logout')</button>
                            </form>
                        </div>
                    @endif
                </div>
                @if(session()->has('success'))
                    <div x-data="{show:true}"
                         x-show="show"
                         x-init="setTimeout(() => show = false, 4000)"
                         class="bg-green-500 text-white p-2 rounded-lg">
                        {{session('success')}}
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{--    <div class="border border-gray-100 w-full block"></div>--}}
</header>
{{$slot}}
</body>
</html>
