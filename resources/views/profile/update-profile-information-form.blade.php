<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Informasi Profil') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Perbarui informasi profil dan alamat email.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        {{-- @if (Laravel\Jetstream\Jetstream::managesProfilePhotos()) --}}
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label class="text-xl font-semibold text-gray-600" for="photo" value="{{ __('Foto') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2 mb-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" width="200" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                          x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="py-3 px-7 bg-blue-50 transform hover:scale-95 duration-300 border-none shadow-md focus:outline-none rounded-xl mt-2 font-normal" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="border-none shadow-md focus:outline-none rounded-xl mt-2 font-normal mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        {{-- @endif --}}

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label class="text-gray-600" for="name" value="{{ __('Username') }}" />
            <x-jet-input id="name" type="text" class="border-none shadow-inner focus:outline-none rounded-xl mt-2 font-normal mt-1 block w-full bg-gray-100 text-sm py-2.5" wire:model.defer="state.name" autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label class="text-gray-600" for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="border-none shadow-inner focus:outline-none rounded-xl mt-2 font-normal mt-1 block w-full bg-gray-100 text-sm py-2.5" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
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
