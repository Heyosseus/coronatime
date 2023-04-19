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
        <img src="/storage/logo.png" alt="logo" class="lg:w-56">
        <div class="flex justify-between items-center lg:text-lg">

            <div class="flex items-center justify-center space-x-3 w-25 mr-9">
                <a class="rounded-full bg-bg-blue py-3 px-3.5 text-sm">
                    {{ Config::get('languages')[App::getLocale()] }}
                </a>
                <div class="rounded-full bg-bg-blue  py-3 px-3.5  text-sm ">
                    @foreach (Config::get('languages') as $lang => $language)
                        @if ($lang != App::getLocale())
                            <a class="" href="{{ route('lang.switch', $lang) }}"> {{$language}}</a>
                        @endif
                    @endforeach
                </div>

            </div>

            <div x-data="{ show: false }">

                <button @click="show = !show" class="block lg:hidden mt-0.5">
                    <img src="/storage/menu-icon.png" alt="" class="cursor-pointer">
                </button>

                <div x-show="show">
                    @if (auth()->check())

                        <p class="fixed right-5  bg-gray-300 py-2 mt-1 px-16 rounded uppercase font-bold text-center">{{ auth()->user()->name }}</p>
                        <form action="{{ route('logout') }}" method="POST"
                              class="fixed right-1 py-2  px-16 mt-10 rounded font-bold">
                            @csrf
                            <button type="submit" class="uppercase text-center">Logout</button>
                        </form>

                    @else
                        <a href="{{route('login')}}"
                           class="fixed right-5 py-2 bg-gray-300 px-16 mt-4 rounded uppercase font-bold">Log in</a>
                    @endif
                </div>
                <div class="hidden lg:block">
                    @if (auth()->check())
                        <div class="flex space-x-6">
                            <div class="font-bold">{{auth()->user()->name}}</div>
                            <div class="w-0.5 h-6 bg-gray-400 "></div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit">Logout</button>
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
