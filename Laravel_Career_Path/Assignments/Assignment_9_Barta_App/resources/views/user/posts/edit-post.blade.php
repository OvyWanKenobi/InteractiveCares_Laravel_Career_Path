@extends('layouts.app')

@section('main-contents')
    <main class="container mx-auto mt-8 min-h-screen max-w-2xl space-y-8 px-2">

        @if ($errors->has('error'))
            <div class="rounded-xl bg-red-500 text-sm text-white shadow-lg" role="alert" tabindex="-1"
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

        {{-- {{ dd($post) }} --}}

        <!-- Barta Create Post Card -->

        <h1 class="">Edit Post</h1>
        <form action="{{ route('posts.update', ['post' => $post->id]) }} " method="POST" enctype="multipart/form-data"
            novalidate
            class="mx-auto max-w-none space-y-3 rounded-lg border-2 border-black bg-white px-4 py-5 shadow sm:px-6">
            @csrf
            @method('PATCH')

            <!-- Create Post Card Top -->
            <div>
                <div class="/space-x-3/ flex flex-col items-start">

                    <div class="flex items-center space-x-3">


                        <!-- User Info -->
                        <div class="flex min-w-0 flex-1 flex-col text-gray-900">
                            <a href="{{ route('profile', ['user' => $post->user->username]) }}"
                                class="line-clamp-1 font-semibold hover:underline">
                                {{ $post->user->fullname }}
                            </a>

                            <a href="{{ route('profile', ['user' => $post->user->username]) }}"
                                class="line-clamp-1 text-sm text-gray-500 hover:underline">
                                {{ '@' . $post->user->username }}
                            </a>
                        </div>
                        <!-- /User Info -->
                    </div>
                    <!-- Content -->
                    <div class="w-full py-3 font-normal text-gray-700">
                        <textarea
                            class="block w-full rounded-lg border-2 border-gray-300 p-2 pt-3 text-gray-900 focus:ring-0 focus:ring-offset-0"
                            name="barta-post" id="barta-post" rows="4">{{ old('barta-post', $post->content) }}</textarea>

                        @if ($post->post_image_file)
                            <img src="{{ $post->post_image_file }}"
                                class="min-h-auto mt-3 max-h-64 rounded-lg object-cover md:max-h-72" alt="post image" />
                        @endif

                    </div>
                </div>
            </div>
            <div class="text-sm text-red-500">
                @error('barta-post')
                    {{ $message }}
                @enderror
            </div>
            <!-- Create Post Card Bottom -->
            <div>
                <!-- Card Bottom Action Buttons -->
                <div class="flex items-center justify-end">
                    <div>
                        <!-- Post Button -->
                        <button type="submit"
                            class="-m-2 flex items-center gap-2 rounded-full bg-gray-800 px-4 py-2 text-xs font-semibold text-white hover:bg-black">
                            Update
                        </button>
                        <!-- /Post Button -->
                    </div>
                </div>
                <!-- /Card Bottom Action Buttons -->
            </div>
            <!-- /Create Post Card Bottom -->
        </form>
        <!-- /Barta Create Post Card -->


    </main>
@endsection
