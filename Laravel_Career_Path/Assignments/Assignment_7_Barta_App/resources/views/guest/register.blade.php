@extends('layouts.app')


@section('main-contents')
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <a href="./index.html" class="text-center text-6xl font-bold text-gray-900">
                <h1>Barta</h1>
            </a>
            <h1 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                Create a new account
            </h1>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">

            @if ($errors->has('db_error'))
                <div class="max-w-xs rounded-xl bg-red-500 text-sm text-white shadow-lg" role="alert" tabindex="-1"
                    aria-labelledby="hs-toast-solid-color-red-label">
                    <div id="hs-toast-solid-color-red-label" class="flex p-4">
                        {{ $errors->first('db_error') }}

                        <div class="ms-auto">
                            <button type="button"
                                class="size-5 inline-flex shrink-0 items-center justify-center rounded-lg text-white opacity-50 hover:text-white hover:opacity-100 focus:opacity-100 focus:outline-none"
                                aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 6 6 18"></path>
                                    <path d="m6 6 12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endif


            <form class="space-y-6" action="{{ route('register-submit') }}" method="POST" novalidate>
                <!-- Name -->
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Full Name</label>
                    <div class="mt-2">
                        <input id="fullname" name="fullname" type="text" autocomplete="fullname"
                            placeholder="Ashiqur Rahman" value="{{ old('fullname') }}"
                            class="@error('fullname')
                                !border-red-600 !border-1
                            @enderror block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
                        <div class="text-sm text-red-500">
                            @error('fullname')
                                {{ $message }}
                            @enderror
                        </div>

                    </div>
                </div>

                <!-- Username -->
                <div>
                    <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                    <div class="mt-2">
                        <input id="username" name="username" type="text" autocomplete="username" placeholder="ovywan777"
                            value="{{ old('username') }}"
                            class="@error('username')
                                !border-red-600 !border-1
                            @enderror block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />

                        <div class="text-sm text-red-500">
                            @error('username')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email"
                            placeholder="ashiqur.ovy@mail.com" value="{{ old('email') }}"
                            class="@error('email')
                                !border-red-600 !border-1
                            @enderror block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
                        <div class="text-sm text-red-500">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password"
                            placeholder="••••••••"
                            class="@error('password')
                                !border-red-600 !border-1
                            @enderror block w-full rounded-md border-0 p-2 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
                        <div class="text-sm text-red-500">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </div>

                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-black focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black">
                        Register
                    </button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Already a member?
                <a href="{{ route('login') }}" class="font-semibold leading-6 text-black hover:text-black">Sign In</a>
            </p>
        </div>
    </div>
@endsection
