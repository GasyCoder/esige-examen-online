<x-guest-layout>
    <!-- Session Status -->
    <div class="bg-white border rounded-sm border-stroke shadow-default dark:border-strokedark dark:bg-boxdark">
        <div class="flex flex-wrap items-center">
            <div class="hidden w-full border-stroke dark:border-strokedark xl:block xl:w-1/2 xl:border-r-2">
                <div class="px-26 py-17.5 text-center">
                    <a class="mb-5.5 inline-block" href="/">
                        <x-application-logo class="block w-auto text-gray-800 fill-current h-9 dark:text-gray-200" />
                    </a>
    
                    <p class="font-medium 2xl:px-20">
                       {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link
                        that will allow you to choose a new one.') }}
                    </p>
    
                    <span class="inline-block mt-15">
                        <img src="{{ asset('images/illustration-03.svg') }}" alt="illustration">
                    </span>
                </div>
            </div>
            <div class="w-full xl:w-1/2">
                <div class="w-full p-4 sm:p-12.5 xl:p-17.5">
                    <h2 class="mb-3 text-2xl font-bold text-black dark:text-white sm:text-title-xl2">
                        {{ __('Reset Password') }}
                    </h2>
                    <p class="mb-7.5 font-medium">
                        {{ __('Enter your email address to receive a password reset link.') }}
                    </p>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-6">
                            <x-input-label for="email" :value="__('Email')" />
                            <div class="relative">
                                <x-text-input type="email" id="email" placeholder="Saisir ici votre email" name="email" :value="old('email')" autofocus
                                    class="w-full py-4 pl-6 pr-10 bg-transparent border rounded-lg outline-none border-stroke focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"/>
                                <span class="absolute right-4 top-4">
                                    <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g opacity="0.5">
                                            <path
                                                d="M19.2516 3.30005H2.75156C1.58281 3.30005 0.585938 4.26255 0.585938 5.46567V16.6032C0.585938 17.7719 1.54844 18.7688 2.75156 18.7688H19.2516C20.4203 18.7688 21.4172 17.8063 21.4172 16.6032V5.4313C21.4172 4.26255 20.4203 3.30005 19.2516 3.30005ZM19.2516 4.84692C19.2859 4.84692 19.3203 4.84692 19.3547 4.84692L11.0016 10.2094L2.64844 4.84692C2.68281 4.84692 2.71719 4.84692 2.75156 4.84692H19.2516ZM19.2516 17.1532H2.75156C2.40781 17.1532 2.13281 16.8782 2.13281 16.5344V6.35942L10.1766 11.5157C10.4172 11.6875 10.6922 11.7563 10.9672 11.7563C11.2422 11.7563 11.5172 11.6875 11.7578 11.5157L19.8016 6.35942V16.5688C19.8703 16.9125 19.5953 17.1532 19.2516 17.1532Z"
                                                fill=""></path>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        <div class="mb-5">
                            <x-primary-button>
                                {{ __('Email Password Reset Link') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
