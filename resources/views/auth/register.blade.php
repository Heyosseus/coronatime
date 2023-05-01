<x-layout>
    <div class="lg:px-12">
        <h1 class="font-bold px-6 text-2xl w-[444px]">@lang('register.title')</h1>
        <p class="text-sm px-6 mt-3 w-form">@lang('register.paragraph')</p>

        <form action="{{route('post_register')}}" method="POST" class="flex flex-col px-6 space-y-2 lg:w-login-form ">
            @csrf
            <label for="name" class="font-bold py-2">
                @lang('register.username')
            </label>
            <input type="text" name="name" id="name" placeholder="@lang('register.enter_name')"
                   class="p-4 rounded-lg w-full form-input
                  @if($errors->has('name')) border-red-500
                  @elseif(! $errors->any() && ! old('name')) border-gray-300
                  @else border-green-500 @endif"
            >
            @if($errors->has('name'))
                <div class="flex space-x-1">
                    <img src="{{asset('assets/invalid.png')}}" alt="" width="20" height="10">
                    <p class="text-red-500 text-xs mt-1">{{ $errors->first('name') }}</p>
                </div>
            @endif


            <label for="email" class="font-bold py-2">
                @lang('register.email')
            </label>
            <input type="email" name="email" id="email" placeholder="@lang('register.enter_email')"
                   class="p-4 rounded-lg w-full form-input
                  @if($errors->has('email')) border-red-500
                  @elseif(! $errors->any() && ! old('email')) border-gray-300
                  @else border-green-500 @endif"
            >
            @error( 'email' )
            <div class="flex space-x-1">
                <img src="{{asset('assets/invalid.png')}}" alt="" width="20" height="10">
                <p class="text-red-500 text-xs mt-1">{{ $errors->first('email') }}</p>
            </div>
            @enderror

            <label for="password" class="font-bold py-2">
                @lang('register.password')
            </label>
            <input type="password" name="password" id="password" placeholder="@lang('register.enter_password')"
                   class="p-4 rounded-lg w-full form-input
                  @if($errors->has('name')) border-red-500
                  @elseif(! $errors->any() && ! old('password')) border-gray-300
                  @else border-green-500 @endif"
            >
            @error( 'password' )
            <div class="flex space-x-1">
                <img src="{{asset('assets/invalid.png')}}" alt="" width="20" height="10">
                <p class="text-red-500 text-xs mt-1">{{ $errors->first('password') }}</p>
            </div>
            @enderror

            <label for="password_confirmation" class="font-bold py-2">
                @lang('register.repeat')
            </label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="@lang('register.repeat')"
                   class="p-4 rounded-lg w-full form-input
                  @if($errors->has('password_confirmation')) border-red-500
                  @elseif(! $errors->any() && ! old('password_confirmation')) border-gray-300
                  @else border-green-500 @endif"
            >
            @error( 'password_confirmation' )
            <div class="flex space-x-1">
                <img src="{{asset('assets/invalid.png')}}" alt="" width="20" height="10">
                <p class="text-red-500 text-xs mt-1">{{ $errors->first('password_confirmation') }}</p>
            </div>
            @enderror


            <button type="submit" class="bg-green-600 text-white p-3 mt-8  rounded hover:bg-blue-400 font-bold">@lang('register.sign_up')
            </button>

            <p class="text-center py-4 ">@lang('register.account') <a href="{{route('login')}}" class="font-bold ">@lang('register.login')</a></p>
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
    </div>
</x-layout>
