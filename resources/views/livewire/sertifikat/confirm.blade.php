<div class="fixed inset-0 z-10 overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen text-center sm:block">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-50"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>

        <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-gray-100 shadow-xl rounded-xl sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
        <!--content-->
            <div class="">
            <!--body-->
                <div class="justify-center flex-auto mt-10 text-center">
                    <img class="flex items-center mx-auto text-red-500" src="https://img.icons8.com/nolan/100/approve-and-update.png"/>
                    <h2 class="mt-6 mb-1 text-xl font-bold text-gray-600">Ingin Mengubah Status?</h2>
                    <p class="px-8 text-sm text-gray-600">Data Akan Menjadi {{$statuses[$status+10]}}</p>
                </div>
                <!--footer-->
                <div wire:click="hideUpdate()" class="mt-8 mb-10 text-center">
                    <button style="background-color: #E42025;" class="py-3 mr-2 text-sm text-white duration-300 transform bg-green-500 shadow-md hover:scale-95 px-7 md:mb-0 hover:bg-green-700 rounded-xl focus:outline-none">
                        Kembali
                    </button>
                    <button style="background-color: #078CAA;" wire:click="update({{ $this->updateId }})" class="py-3 text-sm text-white duration-300 transform bg-red-500 shadow-md hover:scale-95 px-7 md:mb-0 hover:bg-red-700 rounded-xl focus:outline-none">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>
