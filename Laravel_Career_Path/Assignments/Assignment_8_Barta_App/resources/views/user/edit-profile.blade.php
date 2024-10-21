@extends('layouts.app')

@section('main-contents')
    <main class="container mx-auto mt-8 min-h-screen max-w-xl space-y-8 px-2 md:px-0">
        <!-- Profile Edit Form -->
        @if (session('message'))
            <div class="rounded-xl border border-gray-200 bg-white shadow-lg dark:border-neutral-700 dark:bg-neutral-800"
                role="alert" tabindex="-1" aria-labelledby="hs-toast-success-example-label">
                <div class="flex p-4">
                    <div class="shrink-0">
                        <svg class="size-4 mt-0.5 shrink-0 text-teal-500" xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="currentColor" viewBox="0 0 16 16">
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


        @if ($errors->has('error'))
            <div class="max-w-xs rounded-xl bg-red-500 text-sm text-white shadow-lg" role="alert" tabindex="-1"
                aria-labelledby="hs-toast-solid-color-red-label">
                <div id="hs-toast-solid-color-red-label" class="flex p-4">
                    {{ $errors->first('error') }}

                    <div class="ms-auto">
                        <button type="button"
                            class="size-5 inline-flex shrink-0 items-center justify-center rounded-lg text-white opacity-50 hover:text-white hover:opacity-100 focus:opacity-100 focus:outline-none"
                            aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('edit-profile-submit') }} " method="POST" novalidate>
            @csrf
            @method('PUT')
            <div class="space-y-12">

                <h2 class="text-xl font-semibold leading-7 text-gray-900">
                    Edit Profile
                </h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">
                    This information will be displayed publicly so be careful what you
                    share.
                </p>
                <span class="text-sm leading-6 text-red-600"> * Inputs are Required to update the profile</span>
                {{-- {{ dd($user) }} --}}
                <div class="mt-5 border-b border-gray-900/10 pb-12">
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="first-name" class="flex text-sm font-medium leading-6 text-gray-900">First
                                name <p class="ms-1 text-sm leading-6 text-red-500">
                                    *
                                </p></label>
                            <div class="mt-2">
                                <input type="text" name="first-name" id="first-name" autocomplete="given-name"
                                    value=" {{ old('first-name', $user['firstname']) }} "
                                    class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
                                <div class="text-sm text-red-500">
                                    @error('first-name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="last-name" class="flex text-sm font-medium leading-6 text-gray-900">Last
                                name <p class="ms-1 text-sm leading-6 text-red-500">
                                    *
                                </p></label>
                            <div class="mt-2">
                                <input type="text" name="last-name" id="last-name"
                                    value="{{ old('last-name', $user['lastname']) }}" autocomplete="family-name"
                                    class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
                                <div class="text-sm text-red-500">
                                    @error('last-name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-span-full">
                            <label for="email" class="flex text-sm font-medium leading-6 text-gray-900">Email
                                address <p class="ms-1 text-sm leading-6 text-red-500">
                                    *
                                </p></label>
                            <div class="mt-2">
                                <input id="email" name="email" type="email" autocomplete="email"
                                    value=" {{ old('email', $user['email']) }}"
                                    class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
                                <div class="text-sm text-red-500">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-span-full">
                            <label for="current-password" class="flex text-sm font-medium leading-6 text-gray-900">Current
                                Password <p class="ms-1 text-sm leading-6 text-red-500">
                                    *
                                </p></label>
                            <div class="mt-2">
                                <input type="current-password" name="current-password" id="current-password"
                                    autocomplete="current-password"
                                    class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
                                <div class="text-sm text-red-500">
                                    @error('current-password')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-span-full">
                            <label for="new-password" class="block text-sm font-medium leading-6 text-gray-900">New
                                Password</label>
                            <div class="mt-2">
                                <input type="new-password" name="new-password" id="new-password" autocomplete="new-password"
                                    class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
                                <div class="text-sm text-red-500">
                                    @error('new-password')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-span-full">
                            <label for="bio" class="block text-sm font-medium leading-6 text-gray-900">Bio</label>
                            <div class="mt-2">
                                <textarea id="bio" name="bio" rows="3"
                                    class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6"
                                    placeholder="Write a few sentences about yourself.">{{ old('bio', $user['bio']) }}</textarea>
                                <div class="text-sm text-red-500">
                                    @error('bio')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>



            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="button" onclick="window.location.href='{{ route('profile') }}'"
                    class="text-sm font-semibold leading-6 text-gray-900">
                    Cancel
                </button>
                <button type="submit"
                    class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                    Save
                </button>
            </div>
        </form>
        <!-- /Profile Edit Form -->
    </main>
@endsection
