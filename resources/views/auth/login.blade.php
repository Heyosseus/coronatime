<x-layout>
    <div class="lg:px-12 ">
        <h1 class="font-bold px-6 text-2xl">@lang('login.welcome')</h1>
        <p class="text-sm px-6 mt-3">@lang('login.paragraph')</p>

        <form action="{{route('post_login')}}" method="POST" class="flex flex-col px-6 lg:w-login-form ">
        @csrf
        <label for="name" class="font-bold py-2 mt-10">
            @lang('login.username')
        </label>
        <input type="text" name="name" id="name" placeholder="@lang('login.enter_username')"
               class="@if($errors->has('name')) border-red-500 @elseif(! $errors->any()) border-gray-300 @endif p-4 rounded-lg w-full form-input">

        @if($errors->has('name'))
            <div class="flex space-x-1 mt-1">
                <img src="/storage/invalid.png" alt="" width="20" height="10">
                <p class="text-red-500 text-xs mt-1">{{ $errors->first('name') }}</p>
            </div>
        @endif
        <label for="password" class="font-bold py-2 mt-6">
            @lang('login.password')
        </label>
        <input type="password" name="password" id="password" placeholder="@lang('login.enter_password')"
               class="@if($errors->has('name')) border-red-500 @elseif(! $errors->any()) border-gray-300 @endif p-4 rounded-lg w-full form-input"
        >
        @if($errors->has('password'))
            <div class="flex space-x-1 mt-1">
                <img src="/storage/invalid.png" alt="" width="20" height="10">
                <p class="text-red-500 text-xs mt-1">{{ $errors->first('password') }}</p>
            </div>
        @endif

        <div class="flex items-center justify-between mt-6">
            <div class="">
                <input type="checkbox" name="remember_device" id="remember_device" class="form-checkbox">
                <label for="remember_device" class="font-bold text-sm ">@lang('login.remember')</label>
            </div>
            <a href="{{route('reset_password')}}" class="text-sm text-blue-600 font-bold">@lang('login.forgot')</a>
        </div>


        <button type="submit" class="bg-green-600 text-white p-3 mt-10 rounded hover:bg-blue-400 font-bold">@lang('login.login')</button>



        <p class="text-center py-8 flex justify-around">@lang('login.account')<a href="{{route('register')}}" class="font-bold ">@lang('login.sign_up')</a></p>
            <div class="flex items-center justify-center space-x-3 mr-9 w-full mx-auto">
                <p>@lang('home.switch')</p>
                <a class="rounded-2xl bg-green-600 text-white py-2 px-5 font-bold ">
                    {{ Config::get('languages')[App::getLocale()] }}
                </a>
                <div class="rounded-2xl bg-green-600 text-white py-2 px-5 font-bold ">
                    @foreach (Config::get('languages') as $lang => $language)
                        @if ($lang != App::getLocale())
                            <a class="" href="{{ route('lang.switch', $lang) }}"> {{$language}}</a>
                        @endif
                    @endforeach
                </div>
            </div>
        </form>
        @if(session('success'))
            <p class="text-green-500">{{ session('success') }}</p>
        @endif

    </div>

</x-layout>
