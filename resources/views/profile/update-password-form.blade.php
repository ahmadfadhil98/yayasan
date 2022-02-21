<x-jet-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Ubah Password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Pastikan akun menggunakan password acak dan panjang agar tetap aman.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label class="text-gray-600" for="current_password" value="{{ __('Password Sekarang') }}" />
            <x-jet-input id="current_password" type="password" class="border-none shadow-inner focus:outline-none rounded-xl mt-2 font-normal mt-1 block w-full bg-gray-100 text-sm py-2.5" wire:model.defer="state.current_password" autocomplete="current-password" />
            <x-jet-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label class="text-gray-600" for="password" value="{{ __('Password Baru') }}" />
            <x-jet-input id="password" type="password" class="border-none shadow-inner focus:outline-none rounded-xl mt-2 font-normal mt-1 block w-full bg-gray-100 text-sm py-2.5" wire:model.defer="state.password" autocomplete="new-password" />
            <x-jet-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label class="text-gray-600" for="password_confirmation" value="{{ __('Ulangi Password') }}" />
            <x-jet-input id="password_confirmation" type="password" class="border-none shadow-inner focus:outline-none rounded-xl mt-2 font-normal mt-1 block w-full bg-gray-100 text-sm py-2.5" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
            <x-jet-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Tersimpan!') }}
        </x-jet-action-message>

        <x-jet-button style="background-color: #078CAA;" class="py-3 px-7 transform hover:scale-95 duration-300 border-none shadow-md focus:outline-none rounded-xl mt-1 mb-1 font-normal">
            {{ __('Simpan') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
