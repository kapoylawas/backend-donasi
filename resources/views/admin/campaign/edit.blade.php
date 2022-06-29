@extends('layouts.app', ['title' => 'Tambah Campaign - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container px-6 py-8 mx-auto">

        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="text-lg font-semibold text-gray-700 capitalize">EDIT CAMPAIGN</h2>
            <hr class="mt-4">
            <form action="{{ route('admin.campaign.update', $campaign->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-6 mt-4">
                    <div>
                        <label class="text-gray-700" for="image">GAMBAR</label>
                        <input class="w-full p-3 mt-2 bg-gray-200 rounded-md form-input focus:bg-white" type="file" name="image">
                    </div>

                    <div>
                        <label class="text-gray-700" for="name">JUDUL CAMPAIGN</label>
                        <input class="w-full mt-2 bg-gray-200 rounded-md form-input focus:bg-white" type="text" name="title" value="{{ old('title', $campaign->title) }}" placeholder="Judul Campaign">
                        @error('title')
                            <div class="w-full mt-2 overflow-hidden bg-red-200 rounded-md shadow-sm">
                                <div class="px-4 py-2">
                                    <p class="text-sm text-gray-600">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>

                    <div>
                        <label class="text-gray-700" for="name">KATEGORI</label>
                        <select class="w-full px-3 py-2 bg-gray-200 border rounded outline-none focus:bg-white" name="category_id">
                            @foreach($categories as $category)
                                <option class="py-1" value="{{ $category->id }}" @if($campaign->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                          </select>
                        @error('category_id')
                            <div class="w-full mt-2 overflow-hidden bg-red-200 rounded-md shadow-sm">
                                <div class="px-4 py-2">
                                    <p class="text-sm text-gray-600">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>

                    <div>
                        <label class="text-gray-700" for="name">DESKRIPSI</label>
                        <textarea name="description" rows="5">{{ old('description', $campaign->description) }}</textarea>
                        @error('description')
                            <div class="w-full mt-2 overflow-hidden bg-red-200 rounded-md shadow-sm">
                                <div class="px-4 py-2">
                                    <p class="text-sm text-gray-600">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>

                    <div>
                        <label class="text-gray-700" for="name">TARGET DONASI</label>
                        <input class="w-full p-3 mt-2 bg-gray-200 rounded-md form-input focus:bg-white" type="number" name="target_donation" value="{{ old('target_donation', $campaign->target_donation) }}" placeholder="Target Donasi, Ex: 10000000">
                        @error('target_donation')
                            <div class="w-full mt-2 overflow-hidden bg-red-200 rounded-md shadow-sm">
                                <div class="px-4 py-2">
                                    <p class="text-sm text-gray-600">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>

                    <div>
                        <label class="text-gray-700" for="name">TANGGAL BERAKHIR</label>
                        <input class="w-full p-3 mt-2 bg-gray-200 rounded-md form-input focus:bg-white" type="date" name="max_date" value="{{ old('max_date', $campaign->max_date) }}">
                        @error('max_date')
                            <div class="w-full mt-2 overflow-hidden bg-red-200 rounded-md shadow-sm">
                                <div class="px-4 py-2">
                                    <p class="text-sm text-gray-600">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="flex justify-start mt-4">
                    <button type="submit" class="px-4 py-2 text-gray-200 bg-gray-600 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">UPDATE</button>
                </div>
            </form>
        </div>
        
    </div>
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.7.0/tinymce.min.js"></script>
<script>
    tinymce.init({selector:'textarea'});
</script>
@endsection