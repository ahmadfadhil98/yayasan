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
                    <svg xmlns="http://www.w3.org/2000/svg" class="flex items-center w-12 h-12 mx-auto text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    <h2 class="mt-6 mb-1 text-xl font-bold text-gray-600">Ingin Menghapus?</h2>
                    <p class="px-8 text-sm text-gray-600">Data akan terhapus secara permanen!</p>
                </div>
                <!--footer-->
                <div wire:click="hideDel()" class="mt-8 mb-10 text-center">
                    <button style="background-color: #078CAA;" class="py-3 mr-2 text-sm text-white duration-300 transform bg-green-500 shadow-md hover:scale-95 px-7 md:mb-0 hover:bg-green-700 rounded-xl focus:outline-none">
                        Kembali
                    </button>
                    <button style="background-color: #E42025;" wire:click="delete({{ $this->delId }})" class="py-3 text-sm text-white duration-300 transform bg-red-500 shadow-md hover:scale-95 px-7 md:mb-0 hover:bg-red-700 rounded-xl focus:outline-none">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>
