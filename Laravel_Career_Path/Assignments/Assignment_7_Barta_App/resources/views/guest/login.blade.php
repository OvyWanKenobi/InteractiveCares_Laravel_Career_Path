@extends('layouts.app')


@section('main-contents')
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <a href="./index.html" class="text-center text-6xl font-bold text-gray-900">
                <h1>Barta</h1>
            </a>

            <h1 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                Sign in to your account
            </h1>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            @if (session('message'))
                <div class="rounded-xl border border-gray-200 bg-white shadow-lg dark:border-neutral-700 dark:bg-neutral-800"
                    role="alert" tabindex="-1" aria-labelledby="hs-toast-success-example-label">
                    <div class="flex p-4">
                        <div class="shrink-0">
                            <svg class="size-4 mt-0.5 shrink-0 text-teal-500" xmlns="http://www.w3.org/2000/svg"
                                width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z">
                                </path>
                            </svg>
                        </div>
                        <div class="ms-3">
                            <p id="hs-toast-success-example-label" class="text-sm text-gray-700 dark:text-neutral-400">
                                {{ session('message') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- {{ print_r($errors) }} --}}
            @if ($errors->has('login_error'))
                <div class="rounded-xl border border-gray-200 bg-white shadow-lg dark:border-neutral-700 dark:bg-neutral-800"
                    role="alert" tabindex="-1" aria-labelledby="hs-toast-error-example-label">
                    <div class="flex p-4">
                        <div class="shrink-0">
                            <svg class="size-4 mt-0.5 shrink-0 text-red-500" xmlns="http://www.w3.org/2000/svg"
                                width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z">
                                </path>
                            </svg>
                        </div>
                        <div class="ms-3">
                            <p id="hs-toast-error-example-label" class="text-sm text-gray-700 dark:text-neutral-400">
                                {{ $errors->first('login_error') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif



            <form class="space-y-6" action="{{ route('login-submit') }}" method="POST" novalidate>
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email"
                            placeholder="bruce@wayne.com" value="{{ old('email') }}"
                            class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
                        <div class="text-sm text-red-500">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                        <div class="text-sm">
                            <a href="#" class="font-semibold text-black hover:text-black">Forgot password?</a>
                        </div>

                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password"
                            placeholder="••••••••" require
                            class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
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
                        Sign in
                    </button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Don't have an account yet?
                <a href="{{ route('register') }}" class="font-semibold leading-6 text-black hover:text-black">Sign Up</a>
            </p>
        </div>
    </div>
@endsection
