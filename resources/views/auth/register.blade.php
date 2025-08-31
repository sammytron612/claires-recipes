@extends('layouts.app1')

@section('content')
<div style="background-color:#fffef7" class="max-w-7xl mx-auto py-5 border border-gray-800 shadow-lg">
    <div class="flex flex-col lg:flex-row w-full justify-center items-center">
        <div class="w-full lg:w-1/2 flex justify-center mb-6 lg:mb-0">
            <img src="{{asset('storage/claires-recipes.png')}}" alt="Site Logo">
        </div>
        <div class="w-full lg:w-1/2">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="text-center text-xl font-medium bg-gray-800 text-white py-3">{{ __('Register') }}</div>

                <div class="p-6">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Name') }}</label>
                            <input id="name" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 @error('name') border-red-500 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="text-red-500 text-sm mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="text-red-500 text-sm mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Password') }}</label>
                            <input id="password" type="password" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="text-red-500 text-sm mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="password-confirm" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="flex justify-center">
                            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
