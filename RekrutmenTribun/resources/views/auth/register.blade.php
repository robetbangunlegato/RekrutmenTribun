<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="logo_tribun.png" class="w-100 h-20 fill-current" alt="logo tribun">
            </a>

        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Nama')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
            </div>

            {{-- nomor WA --}}
            <div class="mt-4">
                <x-label for="noWA" :value="__('Nomor WhatsApp')" />
                <x-input id="noWA" class="block mt-1 w-full" type="text" name="noWA" :value="old('noWA')"
                    required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Kata Sandi')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div>

            <button class="btn btn-primary col-lg-12 col-md-12 col-sm-12 mt-3" type="submit">Daftarkan</button>
            <a href="{{ route('login') }}" class="btn btn-secondary col-lg-12 col-md-12 col-sm-12 mt-3">Sudah punya
                akun ?</a>
        </form>
    </x-auth-card>
</x-guest-layout>
