@extends('layouts.auth', ['title' => 'Confirm Password - Admin'])

@section('content')
<div class="flex items-center justify-center h-screen px-6 bg-gray-300">
    <div class="w-full max-w-sm p-6 bg-white rounded-md shadow-md">
        <div class="flex items-center justify-center">
            <span class="text-2xl font-semibold text-gray-700">CONFIRM PASSWORD</span>
        </div>
        @if (session('status'))
        <div class="p-3 mt-3 bg-green-500 rounded-md shadow-sm">
            {{ session('status') }}
        </div>
        @endif
        <form class="mt-4" action="{{ route('password.confirm') }}" method="POST">
            @csrf

            <label class="block mt-3">
                <span class="text-sm text-gray-700">Password</span>
                <input type="password" name="password" class="block w-full mt-1 rounded-md form-input focus:border-indigo-600"
                    placeholder="Password">
                @error('password')
                <div class="inline-flex w-full max-w-sm mt-2 overflow-hidden bg-red-200 rounded-md shadow-sm">
                    <div class="px-4 py-2">
                        <p class="text-sm text-gray-600">{{ $message }}</p>
                    </div>
                </div>
                @enderror
            </label>

            <div class="mt-6">
                <button type="submit"
                    class="w-full px-4 py-2 text-sm text-center text-white bg-indigo-600 rounded-md hover:bg-indigo-500 focus:outline-none">
                    CONFIRM PASSWORD
                </button>
            </div>
        </form>
    </div>
</div>
@endsection