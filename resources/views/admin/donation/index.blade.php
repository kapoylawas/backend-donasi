@extends('layouts.app', ['title' => 'Donation - Admin'])

@section('content')

<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container px-6 py-8 mx-auto">
        <form action="{{ route('admin.donation.firter') }}" method="GET">
            <div class="flex gap-6">

                <div class="flex-auto">
                    <label class="text-gray-700" for="name">TANGGAL AWAL</label>
                    <input class="w-full p-3 mt-2 bg-white rounded-md shadow-md form-input" type="date" name="date_from"
                        value="{{ old('date_form') ?? request()->query('date_from') }}">
                    @error('date_from')
                        <div class="w-full mt-2 overflow-hidden bg-red-200 rounded-md shadow-sm">
                            <div class="px-4 py-2">
                                <p class="text-sm text-gray-600">{{ $message }}</p>
                            </div>
                        </div>
                    @enderror    
                </div>

                <div class="flex-auto">
                    <label class="text-gray-700" for="name">TANGGAL AKHIR</label>
                    <input class="w-full p-3 mt-2 bg-white rounded-md shadow-md form-input" type="date" name="date_to"
                        value="{{ old('date_to') ?? request()->query('date_to') }}">
                    @error('date_to')
                        <div class="w-full mt-2 overflow-hidden bg-red-200 rounded-md shadow-sm">
                            <div class="px-4 py-2">
                                <p class="text-sm text-gray-600">{{ $message }}</p>
                            </div>
                        </div>
                    @enderror    
                </div>

                <div class="flex-1">
                    <button type="submit"
                        class="w-full p-3 mt-8 text-gray-200 bg-gray-600 rounded-md shadow-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">FILTER</button>
                </div>

            </div>
        </form>

        @if($donations ?? '')

            @if(count($donations) > 0)

                <div class="px-4 py-4 -mx-4 overflow-x-auto sm:-mx-8 sm:px-8">
                    <div class="inline-block min-w-full overflow-hidden rounded-lg shadow-sm">
                        <table class="min-w-full table-auto">
                            <thead class="justify-between">
                                <tr class="w-full bg-gray-600">
                                    <th class="px-16 py-2">
                                        <span class="text-white">NAMA DONATUR</span>
                                    </th>
                                    <th class="px-16 py-2 text-left">
                                        <span class="text-white">CAMPAIGN</span>
                                    </th>
                                    <th class="px-16 py-2 text-left">
                                        <span class="text-white">TANGGAL</span>
                                    </th>
                                    <th class="px-16 py-2 text-center">
                                        <span class="text-white">JUMLAH DONASI</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-200">
                                @forelse($donations as $donation)
                                    <tr class="bg-white border">
                
                                        <td class="flex justify-center px-16 py-2">
                                            {{ $donation->donatur->name }}
                                        </td>
                                        <td class="px-16 py-2">
                                            {{ $donation->campaign->title }}
                                        </td>
                                        <td class="px-16 py-2">
                                            {{ $donation->created_at }}
                                        </td>
                                        <td class="px-5 py-2 text-right">
                                            {{ moneyFormat($donation->amount) }}
                                        </td>
                                    </tr>
                                @empty
                                    <div class="p-3 text-center text-white bg-red-500 rounded-sm shadow-md">
                                        Data Belum Tersedia!
                                    </div>
                                @endforelse
                                <tr class="font-bold text-white bg-gray-600 border">
                                    <td colspan="3" class="justify-center px-5 py-2">
                                        TOTAL DONASI
                                    </td>
                                    <td colspan="3" class="px-5 py-2 text-right">
                                        {{ moneyFormat($total) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> 

            @endif

        @endif

    </div>
</main>

@endsection