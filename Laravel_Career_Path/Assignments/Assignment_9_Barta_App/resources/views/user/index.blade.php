@extends('layouts.app')

@section('main-contents')
    <main class="container mx-auto mt-8 min-h-screen max-w-xl space-y-8 px-2 md:px-0">

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

        @if (session('message'))
            <script>
                alert('{{ session('message') }}');
            </script>
        @endif


        <!-- Barta Create Post Card -->
        <form method="POST" action="{{ route('posts.store') }} " enctype="multipart/form-data" novalidate
            class="mx-auto max-w-none space-y-3 rounded-lg border-2 border-black bg-white px-4 py-5 shadow sm:px-6">
            @csrf

            <!-- Create Post Card Top -->
            <div>
                <div class="/space-x-3/ flex items-start">
                    <!-- User Avatar -->
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ auth()->user()->profile_picture_img }}"
                            alt="{{ auth()->user()->fullname }}" />
                    </div>
                    <!-- /User Avatar -->

                    <!-- Content -->
                    <div class="w-full font-normal text-gray-700">
                        <textarea
                            class="block w-full rounded-lg border-none p-2 pt-2 text-gray-900 outline-none focus:ring-0 focus:ring-offset-0"
                            name="barta-post" id="barta-post" rows="3" placeholder="What's going on, {{ auth()->user()->firstname }}">{{ old('barta-post') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="text-sm text-red-500">
                @error('barta-post')
                    {{ $message }}
                @enderror

                @error('postimage')
                    {{ $message }}
                @enderror
            </div>

            <!-- Create Post Card Bottom -->
            <div>
                <!-- Card Bottom Action Buttons -->
                <div class="flex items-center justify-between">
                    <!-- Upload Picture Button -->
                    <div>
                        <input type="file" name="postimage" id="postimage" class="hidden" />
                        <img id='post_image_preview' class="w-22 my-1 h-20" style="display: none;" alt="post image" />
                        {{-- preview change script in layout.app --}}

                        <label for="postimage"
                            class="-m-2 flex cursor-pointer items-center gap-2 rounded-full p-2 text-xs text-gray-600 hover:text-gray-800">
                            <span class="sr-only">Picture</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                        </label>
                    </div>
                    <!-- /Upload Picture Button -->

                    <div>
                        <!-- Post Button -->
                        <button type="submit"
                            class="-m-2 flex items-center gap-2 rounded-full bg-gray-800 px-4 py-2 text-xs font-semibold text-white hover:bg-black">
                            Post
                        </button>
                        <!-- /Post Button -->
                    </div>
                </div>
                <!-- /Card Bottom Action Buttons -->
            </div>
            <!-- /Create Post Card Bottom -->
        </form>
        <!-- /Barta Create Post Card -->

        <!-- Newsfeed -->
        <section id="newsfeed" class="space-y-6">


            @if (request('search'))
                <p class="text-black-800 text-lg">{{ '(' . count($posts) . ')' }} search results for
                    '{{ request('search') }}'</p>
            @endif
            @if ($posts->isEmpty())
                <div class="mb-4 flex items-center rounded-lg border border-red-300 bg-red-50 p-4 text-sm text-red-800 dark:border-red-800 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    {{-- <svg class="me-3 inline h-4 w-4 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg> --}}
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="text-center font-medium">No Posts To Load</span>
                    </div>
                </div>
            @else
                @foreach ($posts as $post)
                    <!-- Barta Card -->
                    <article class="mx-auto max-w-none rounded-lg border-2 border-black bg-white px-4 py-5 shadow sm:px-6">
                        <!-- Barta Card Top -->
                        <header>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">

                                    <!-- User Avatar -->
                                    <div class="flex-shrink-0">
                                        <img class="h-10 w-10 rounded-full object-cover"
                                            src="{{ $post->user->profile_picture_img }}"
                                            alt="{{ $post->user->fullname }}" />
                                    </div>
                                    <!-- /User Avatar -->

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
                                @if ($post->user_id === auth()->user()->id)
                                    <!-- Card Action Dropdown -->
                                    <div class="flex flex-shrink-0 self-center" x-data="{ open: false }">
                                        <div class="relative inline-block text-left">
                                            <div>
                                                <button @click="open = !open" type="button"
                                                    class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600"
                                                    id="menu-0-button">
                                                    <span class="sr-only">Open options</span>
                                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                                                        aria-hidden="true">
                                                        <path
                                                            d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <!-- Dropdown menu -->


                                            <div x-show="open" @click.away="open = false"
                                                class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                                role="menu" aria-orientation="vertical"
                                                aria-labelledby="user-menu-button" tabindex="-1">
                                                <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                    role="menuitem" tabindex="-1" id="user-menu-item-0">Edit</a>
                                                <form class=""
                                                    action="{{ route('posts.destroy', ['post' => $post->id]) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this post?');"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100"
                                                        role="menuitem" tabindex="-1" id="user-menu-item-1">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>


                                        </div>

                                    </div>
                                    <!-- /Card Action Dropdown -->
                                @endif
                            </div>
                        </header>

                        <!-- Content -->
                        <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                            <div class="py-4 font-normal text-gray-700">
                                <p>{!! nl2br(e($post->content)) !!}</p>
                                <img src="{{ $post->post_image_file }}"
                                    class="min-h-auto max-h-64 rounded-lg object-cover md:max-h-72" alt="post image" />

                            </div>
                        </a>

                        <!-- Date Created & View Stat -->
                        <div class="my-2 flex items-center gap-2 text-xs text-gray-500">
                            <span class="">{{ $post->created_at->diffForHumans() }}</span>
                            <span class="">•</span>
                            <span>{{ $post->views }} views</span>
                        </div>

                        <!-- Barta Card Bottom -->
                        <footer class="border-t border-gray-200 pt-2">
                            <!-- Card Bottom Action Buttons -->
                            <div class="flex items-center justify-between">
                                <div class="flex gap-8 text-gray-600">
                                    <!-- Comment Button -->
                                    <a href="{{ route('posts.show', ['post' => $post->id]) }}" type="button"
                                        class="-m-2 flex items-center gap-2 rounded-full p-2 text-xs text-gray-600 hover:text-gray-800">
                                        <span class="sr-only">Comment</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="h-5 w-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                                        </svg>

                                        <p>{{ $post->comments_count }}</p>
                                    </a>
                                    <!-- /Comment Button -->
                                </div>
                            </div>
                            <!-- /Card Bottom Action Buttons -->
                        </footer>
                        <!-- /Barta Card Bottom -->
                    </article>
                    <!-- /Barta Card -->
                @endforeach
            @endif







        </section>
        <!-- /Newsfeed -->
    </main>
@endsection
