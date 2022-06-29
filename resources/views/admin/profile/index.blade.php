@extends('layouts.app', ['title' => 'Profile - Admin'])

@section('content')

<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container px-6 py-8 mx-auto">

        @if (session('status'))
        <div class="p-3 mt-3 bg-green-500 rounded-md shadow-sm">
            @if (session('status')=='profile-information-updated')
            Profile has been updated.
            @endif
            @if (session('status')=='password-updated')
            Password has been updated.
            @endif
            @if (session('status')=='two-factor-authentication-disabled')
            Two factor authentication disabled.
            @endif
            @if (session('status')=='two-factor-authentication-enabled')
            Two factor authentication enabled.
            @endif
            @if (session('status')=='recovery-codes-generated')
            Recovery codes generated.
            @endif
        </div>
        @endif

        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">

            <div>
                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::twoFactorAuthentication()))
                    <div class="p-6 bg-white rounded-md shadow-md">
                        <h2 class="text-lg font-semibold text-gray-700 capitalize">TWO-FACTOR AUTHENTICATION</h2>
                        <hr class="mt-4">

                        <div class="mt-4">
                            @if(! auth()->user()->two_factor_secret)
                            {{-- Enable 2FA --}}
                            <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                                @csrf

                                <button type="submit"
                                    class="px-4 py-2 text-gray-200 bg-gray-600 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">
                                    Enable Two-Factor
                                </button>
                            </form>
                            @else
                            {{-- Disable 2FA --}}
                            <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="px-4 py-2 text-gray-200 bg-red-600 rounded-md hover:bg-red-900 focus:outline-none focus:bg-gray-700">
                                    Disable Two-Factor
                                </button>
                            </form>

                            @if(session('status') == 'two-factor-authentication-enabled')
                            {{-- Show SVG QR Code, After Enabling 2FA --}}
                            <div class="mt-4">
                                Otentikasi dua faktor sekarang diaktifkan. Pindai kode QR berikut menggunakan aplikasi
                                pengautentikasi ponsel Anda.
                            </div>

                            <div class="mt-4 mb-3">
                                {!! auth()->user()->twoFactorQrCodeSvg() !!}
                            </div>
                            @endif

                            {{-- Show 2FA Recovery Codes --}}
                            <div class="mt-4">
                                Simpan recovery code ini dengan aman. Ini dapat digunakan untuk memulihkan akses ke akun
                                Anda jika perangkat otentikasi dua faktor Anda hilang.
                            </div>

                            <div style="background: rgb(44, 44, 44);color:white" class="p-3 mt-4 mb-2 rounded">
                                @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
                                <div>{{ $code }}</div>
                                @endforeach
                            </div>

                            {{-- Regenerate 2FA Recovery Codes --}}
                            <form method="POST" action="{{ url('user/two-factor-recovery-codes') }}">
                                @csrf

                                <button type="submit"
                                    class="px-4 py-2 mt-4 text-gray-200 bg-gray-600 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">
                                    Regenerate Recovery Codes
                                </button>
                            </form>
                            @endif
                        </div>

                    </div>
                @endif
            </div>

            <div>
                <div class="p-6 bg-white rounded-md shadow-md">
                    <h2 class="text-lg font-semibold text-gray-700 capitalize">EDIT PROFILE</h2>
                    <hr class="mt-4">
                    <form class="mt-4" action="{{ route('user-profile-information.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block">
                                <span class="text-sm text-gray-700">Nama Lengkap</span>
                                <input type="text" name="name" value="{{ old('name') ?? auth()->user()->name }}"
                                    class="block w-full mt-1 rounded-md form-input" placeholder="Nama Lengkap">
                                @error('name')
                                <div
                                    class="inline-flex w-full max-w-sm mt-2 overflow-hidden bg-red-200 rounded-md shadow-sm">
                                    <div class="px-4 py-2">
                                        <p class="text-sm text-gray-600">{{ $message }}</p>
                                    </div>
                                </div>
                                @enderror
                            </label>
                        </div>
                        <div class="mt-4">
                            <label class="block">
                                <span class="text-sm text-gray-700">Alamat Email</span>
                                <input type="email" name="email" value="{{ old('email') ?? auth()->user()->email }}"
                                    class="block w-full mt-1 rounded-md form-input" placeholder="Alamat Email">
                                @error('email')
                                <div
                                    class="inline-flex w-full max-w-sm mt-2 overflow-hidden bg-red-200 rounded-md shadow-sm">
                                    <div class="px-4 py-2">
                                        <p class="text-sm text-gray-600">{{ $message }}</p>
                                    </div>
                                </div>
                                @enderror
                            </label>
                        </div>
                        <div class="flex justify-start mt-4">
                            <button type="submit"
                                class="px-4 py-2 text-gray-200 bg-gray-600 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">UPDATE
                                PROFILE</button>
                        </div>
                    </form>
                </div>

                <div class="p-6 mt-6 bg-white rounded-md shadow-md">
                    <h2 class="text-lg font-semibold text-gray-700 capitalize">UPDATE PASSWORD</h2>
                    <hr class="mt-4">
                    <form class="mt-4" action="{{ route('user-password.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block">
                                <span class="text-sm text-gray-700">Password Lama</span>
                                <input type="password" name="current_password"
                                    class="block w-full mt-1 rounded-md form-input" placeholder="Password Lama">
                            </label>
                        </div>
                        <div class="mt-4">
                            <label class="block">
                                <span class="text-sm text-gray-700">Password Baru</span>
                                <input type="password" name="password" class="block w-full mt-1 rounded-md form-input"
                                    placeholder="Password Baru">
                            </label>
                        </div>
                        <div class="mt-4">
                            <label class="block">
                                <span class="text-sm text-gray-700">Konfirmasi Password Baru</span>
                                <input type="password" name="password_confirmation"
                                    class="block w-full mt-1 rounded-md form-input"
                                    placeholder="Konfirmasi Password Baru">
                            </label>
                        </div>
                        <div class="flex justify-start mt-4">
                            <button type="submit"
                                class="px-4 py-2 text-gray-200 bg-gray-600 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">UPDATE
                                PASSWORD</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
</main>

@endsection