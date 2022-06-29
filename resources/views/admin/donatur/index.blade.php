@extends('layouts.app', ['title' => 'Donatur - Admin'])

@section('content')

<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container px-6 py-8 mx-auto">

        <div class="flex items-center">
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </span>
                <form action="{{ route('admin.donatur.index') }}" method="GET">
                    <input class="w-full pl-10 pr-4 rounded-lg form-input" type="text" name="q" value="{{ request()->query('q') }}"
                    placeholder="Search">
                </form>
            </div>
        </div>

        <div class="px-4 py-4 -mx-4 overflow-x-auto sm:-mx-8 sm:px-8">
            <div class="inline-block min-w-full overflow-hidden rounded-lg shadow-sm">
                <table class="min-w-full table-auto">
                    <thead class="justify-between">
                        <tr class="w-full bg-gray-600">
                            <th class="px-16 py-2">
                                <span class="text-white">NAMA LENGKAP</span>
                            </th>
                            <th class="px-16 py-2 text-left">
                                <span class="text-white">EMAIL</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-200">
                        @forelse($donaturs as $donatur)
                            <tr class="bg-white border">
        
                                <td class="px-5 py-2">
                                    {{ $donatur->name }}
                                </td>

                                <td class="px-16 py-2">
                                    {{ $donatur->email }}
                                </td>

                            </tr>
                        @empty
                            <div class="p-3 text-center text-white bg-red-500 rounded-sm shadow-md">
                                Data Belum Tersedia!
                            </div>
                        @endforelse
                    </tbody>
                </table>
                @if ($donaturs->hasPages())
                    <div class="p-3 bg-white">
                        {{ $donaturs->links('vendor.pagination.tailwind') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>

@endsection