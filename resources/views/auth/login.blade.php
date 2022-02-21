<x-guest-layout>
    {{-- <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="username" value="{{ __('Username') }}" />
                <x-jet-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Login') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card> --}}

    <!-- component -->
<!-- component -->
<div class="min-h-screen bg-gray-100 flex flex-col justify-center sm:py-6">
    <div class="p-10 xs:p-0 mx-auto md:w-full md:max-w-md" >

        <div class="bg-white shadow-md w-full rounded-xl px-7 py-10">

            <div class="grid justify-items-center">
                <x-jet-application-mark class="block w-auto h-28" />
                {{-- <img src="{{url('/img/logo_unand.png')}}" alt="Image" width="150"/> --}}

                {{-- <div class="mt-1 mb-1 text-base font-bold text-green-500 py-1">
                    <div class="flex">
                        <div class="">Universitas Andalas</div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                </div> --}}
        </div>
            <x-jet-validation-errors class="mb-4" />
            @if (session('status'))
                <div class="mb-4 text-sm text-green-500">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div>
                    <div>
                        <x-jet-label class="text-sm text-gray-600 pb-1" for="username" value="{{ __('Username') }}" />
                        <x-jet-input id="username" class="focus:outline-none bg-gray-50 shadow-inner border-none rounded-xl px-3 py-2 mt-1 mb-5 text-sm w-full" type="text" name="username" :value="old('username')" required autofocus />
                    </div>
                    <div>
                        <x-jet-label class="text-sm text-gray-600 pb-1" for="password" value="{{ __('Password') }}" />
                        <x-jet-input id="password" class="focus:outline-none bg-gray-50 shadow-inner border-none rounded-xl px-3 py-2 mt-1 mb-5 text-sm w-full" type="password" name="password" required autocomplete="current-password" />
                    </div>
                    <div class="block mb-3">
                        <label for="remember_me" class="flex items-center">
                            <input id="remember_me" type="checkbox" class="focus:outline-none bg-gray-50 shadow-inner border-none form-checkbox" name="remember">
                            <span class="ml-3 text-sm text-gray-400">{{ __('Remember me') }}</span>
                        </label>
                    </div>
                    <x-jet-button style="background-color: #078CAA;" class="transform hover:scale-95 duration-300 inline-flex justify-center w-full py-2.5 text-sm leading-6 text-white focus:outline-none rounded-xl shadow-md mb-3">
                        <span class="mr-2">Login</span>
                    </x-jet-button>
                    @if (Route::has('password.request'))
                            <a class="text-sm text-gray-400 hover:text-gray-600 grid justify-end" href="{{ route('password.request') }}">

                                    <span class="inline-block">Forgot Password</span>
                            </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
</x-guest-layout>


