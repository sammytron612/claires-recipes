@extends('layouts.app1')

@section('content')
<div style="background-color:#fffef7" class="max-w-7xl mx-auto py-5 border border-gray-800 shadow-lg">
    <div class="flex flex-col lg:flex-row w-full justify-center items-center">
        <div class="w-full lg:w-1/2 flex justify-center mb-6 lg:mb-0">
            <img src="{{asset('storage/claires-recipes.png')}}" alt="Site Logo">
        </div>
        <div class="w-full lg:w-1/2">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="text-center text-xl font-medium bg-gray-800 text-white py-3">{{ __('Login') }}</div>

                <div class="p-6">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="text-red-500 text-sm mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Password') }}</label>
                            <input id="password" type="password" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="text-red-500 text-sm mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <div class="flex items-center">
                                <input class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="ml-2 block text-sm text-gray-900" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="text-teal-600 hover:text-teal-800 text-sm" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                     </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
