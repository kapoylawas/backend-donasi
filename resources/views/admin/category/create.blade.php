@extends('layouts.app', ['title' => 'Tambah Kategori - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container px-6 py-8 mx-auto">

        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="text-lg font-semibold text-gray-700 capitalize">TAMBAH KATEGORI</h2>
            <hr class="mt-4">
            <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 gap-6 mt-4">
                    <div>
                        <label class="text-gray-700" for="image">GAMBAR</label>
                        <input class="w-full p-3 mt-2 bg-gray-200 rounded-md form-input focus:bg-white" type="file" name="image">
                        @error('image')
                            <div class="w-full mt-2 overflow-hidden bg-red-200 rounded-md shadow-sm">
                                <div class="px-4 py-2">
                                    <p class="text-sm text-gray-600">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>

                    <div>
                        <label class="text-gray-700" for="name">NAMA KATEGORI</label>
                        <input class="w-full mt-2 bg-gray-200 rounded-md form-input focus:bg-white" type="text" name="name" value="{{ old('name') }}" placeholder="Nama Kategori">
                        @error('name')
                            <div class="w-full mt-2 overflow-hidden bg-red-200 rounded-md shadow-sm">
                                <div class="px-4 py-2">
                                    <p class="text-sm text-gray-600">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-start mt-4">
                    <button type="submit" class="px-4 py-2 text-gray-200 bg-gray-600 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">SIMPAN</button>
                </div>
            </form>
        </div>
        
    </div>
</main>
@endsection