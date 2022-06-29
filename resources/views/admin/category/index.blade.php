@extends('layouts.app', ['title' => 'Kategori - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container px-6 py-8 mx-auto">

        <div class="flex items-center">
            <button class="px-4 py-2 text-white bg-gray-600 rounded-md shadow-sm focus:outline-none">
                <a href="{{ route('admin.category.create') }}">TAMBAH</a>
            </button>

            <div class="relative mx-4">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </span>
                <form action="{{ route('admin.category.index') }}" method="GET">
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
                                <span class="text-white">GAMBAR</span>
                            </th>
                            <th class="px-16 py-2 text-left">
                                <span class="text-white">NAMA KATEGORI</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-white">AKSI</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-200">
                        @forelse($categories as $category)
                            <tr class="bg-white border">
        
                                <td class="flex justify-center px-16 py-2">
                                    <img src="{{ $category->image }}" class="w-10 rounded-full h-100 object-fit-cover">
                                </td>
                                <td class="px-16 py-2">
                                    {{ $category->name }}
                                </td>
                                <td class="px-10 py-2 text-center">
                                    <a href="{{ route('admin.category.edit', $category->id) }}" class="px-4 py-2 text-xs text-white bg-indigo-600 rounded shadow-sm focus:outline-none">EDIT</a>
                                    <button onClick="destroy(this.id)" id="{{ $category->id }}" class="px-4 py-2 text-xs text-white bg-red-600 rounded shadow-sm focus:outline-none">HAPUS</button>
                                </td>
                            </tr>
                        @empty
                            <div class="p-3 text-center text-white bg-red-500 rounded-sm shadow-md">
                                Data Belum Tersedia!
                            </div>
                        @endforelse
                    </tbody>
                </table>
                @if ($categories->hasPages())
                    <div class="p-3 bg-white">
                        {{ $categories->links('vendor.pagination.tailwind') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>
<script>
    //ajax delete
    function destroy(id) {
        var id = id;
        var token = $("meta[name='csrf-token']").attr("content");

        Swal.fire({
            title: 'APAKAH KAMU YAKIN ?',
            text: "INGIN MENGHAPUS DATA INI!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'BATAL',
            confirmButtonText: 'YA, HAPUS!',
        }).then((result) => {
            if (result.isConfirmed) {
                //ajax delete
                jQuery.ajax({
                    url: `/admin/category/${id}`,
                    data: {
                        "id": id,
                        "_token": token
                    },
                    type: 'DELETE',
                    success: function (response) {
                        if (response.status == "success") {
                            Swal.fire({
                                icon: 'success',
                                title: 'BERHASIL!',
                                text: 'DATA BERHASIL DIHAPUS!',
                                showConfirmButton: false,
                                timer: 3000
                            }).then(function () {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'GAGAL!',
                                text: 'DATA GAGAL DIHAPUS!',
                                showConfirmButton: false,
                                timer: 3000
                            }).then(function () {
                                location.reload();
                            });
                        }
                    }
                });
            }
        })
    }
</script>
@endsection