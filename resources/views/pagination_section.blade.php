<div>
    @if ($paginator->hasPages())
    <div class="py-3 flex items-center border-t-2 border-gray-200">
        <div class="mt-1 hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
          <div>
            <p class="text-sm text-gray-600">
              Ditemukan
              <span class="font-medium font-bold text-green-500">
                  {{$paginator->total()}}
              </span>
              hasil
            </p>
          </div>
          <div>
            <nav class="relative z-0 inline-flex rounded-lg" aria-label="Pagination">
                <span>
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <a class="transform hover:scale-95 duration-300 mx-2 relative inline-flex items-center px-4 py-1 text-gray-400 bg-white leading-5 rounded-lg focus:outline-none shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                            </svg>
                          </a>
                    @else
                        <button wire:click="previousPage" class="transform hover:scale-95 duration-300 mx-2 relative inline-flex items-center px-4 py-1 text-gray-400 bg-white leading-5 rounded-lg focus:outline-none shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                            </svg>
                          </button>
                    @endif
                </span>
                <ul>
                    @foreach ($elements as $element)
                    <div class="flex">
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    {{-- {{$url}}    --}}
                                    <li style="background-color: #057954;" class="w-10 mx-1 px-2 py-1 text-center text-sm rounded-lg text-white cursor-pointer shadow-md" wire:click="gotoPage({{$page}})">{{$page}}</li>
                                @else
                                    <li class="transform hover:scale-95 duration-300 w-10 mx-1 px-2 py-1 text-center text-sm text-gray-400 rounded-lg bg-white cursor-pointer shadow-md" wire:click="gotoPage({{$page}})">{{$page}}</li>
                                @endif
                            @endforeach
                        @endif
                    </div>
                @endforeach
                </ul>

                <span>
                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <button wire:click="nextPage" wire:loading.attr="disabled" rel="next" class="transform hover:scale-95 duration-300 mx-2 relative inline-flex items-center px-4 py-1 text-gray-400 bg-white leading-5 rounded-lg focus:outline-none shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                            </svg>
                        </button>
                    @else
                        <span class="transform hover:scale-95 duration-300 mx-2 relative inline-flex items-center px-4 py-1 text-gray-400 bg-white leading-5 rounded-lg focus:outline-none shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                            </svg>
                        </span>
                    @endif
                </span>
            </nav>
          </div>
        </div>
    </div>

    @endif
</div>
