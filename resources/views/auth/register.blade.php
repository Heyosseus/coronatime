<x-layout>
    <div class="lg:px-12">
        <h1 class="font-bold px-6 text-2xl">@lang('register.title')</h1>
        <p class="text-sm px-6 mt-3">@lang('register.paragraph')</p>

        <form action="{{route('post_register')}}" method="POST" class="flex flex-col px-6 space-y-2 lg:w-login-form ">
            @csrf
            <label for="name" class="font-bold py-2">
                @lang('register.username')
            </label>
            <input type="text" name="name" id="name" placeholder="@lang('register.enter_name')"
                   class="@if($errors->has('name')) border-red-500 @elseif(! $errors->any()) border-green-500 @endif p-4 rounded-lg w-full form-input"
                   style="background-image: url(@if(!$errors->has('name'))'/storage/valid.png' @endif); background-repeat: no-repeat; background-position: right 10px center"
            >


            @if($errors->has('name'))
                <div class="flex space-x-1">
                    <img src="/storage/invalid.png" alt="" width="20" height="10">
                    <p class="text-red-500 text-xs mt-1">{{ $errors->first('name') }}</p>
                </div>
            @endif


            <label for="email" class="font-bold py-2">
                @lang('register.email')
            </label>
            <input type="email" name="email" id="email" placeholder="@lang('register.enter_email')"
                   class="border-2 border-gray-300 p-4 rounded-lg w-full form-input"
                   style="background-image: url(@if(!$errors->has('name'))'/storage/valid.png' @endif); background-repeat: no-repeat; background-position: right 10px center"
            >
            @error( 'email' )
            <div class="flex space-x-1">
                <img src="/storage/invalid.png" alt="" width="20" height="10">
                <p class="text-red-500 text-xs mt-1">{{ $errors->first('email') }}</p>
            </div>
            @enderror

            <label for="password" class="font-bold py-2">
                @lang('register.password')
            </label>
            <input type="password" name="password" id="password" placeholder="@lang('register.enter_password')"
                   class="border-2 border-gray-300 p-4 rounded-lg w-full form-input"
                   style="background-image: url(@if(!$errors->has('name'))'/storage/valid.png' @endif); background-repeat: no-repeat; background-position: right 10px center"
            >
            @error( 'password' )
            <div class="flex space-x-1">
                <img src="/storage/invalid.png" alt="" width="20" height="10">
                <p class="text-red-500 text-xs mt-1">{{ $errors->first('password') }}</p>
            </div>
            @enderror

            <label for="password_confirmation" class="font-bold py-2">
                @lang('register.repeat')
            </label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="@lang('register.enter_repeat')"
                   class="border-2 border-gray-300 p-4 rounded-lg w-full form-input"
                   style="background-image: url(@if(!$errors->has('name'))'/storage/valid.png' @endif); background-repeat: no-repeat; background-position: right 10px center"
            >
            @error( 'password_confirmation' )
            <div class="flex space-x-1">
                <img src="/storage/invalid.png" alt="" width="20" height="10">
                <p class="text-red-500 text-xs mt-1">{{ $errors->first('password_confirmation') }}</p>
            </div>
            @enderror
            <div class="py-4">
                <input type="checkbox" name="remember_device" id="remember_device">
                <label for="remember_device" class="font-bold text-sm">@lang('register.remember')</label>
            </div>

            <button type="submit" class="bg-green-600 text-white p-3 mt-8 rounded hover:bg-blue-400 font-bold">@lang('register.sign_up')
            </button>

            <p class="text-center py-4 ">@lang('register.account') <a href="{{route('login')}}" class="font-bold ">@lang('register.login')</a></p>
        </form>
    </div>
</x-layout>
