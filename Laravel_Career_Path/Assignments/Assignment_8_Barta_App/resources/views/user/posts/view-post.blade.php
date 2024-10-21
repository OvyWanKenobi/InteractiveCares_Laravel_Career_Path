@extends('layouts.app')

@section('main-contents')
    <main class="container mx-auto mt-8 min-h-screen max-w-2xl space-y-8 px-2">

        <!-- Single post -->
        <section id="newsfeed" class="space-y-6">
            <article class="mx-auto max-w-none rounded-lg border-2 border-black bg-white px-4 py-5 shadow sm:px-6">
                <!-- Barta Card Top -->
                <header>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">


                            <!-- User Info -->
                            <div class="flex min-w-0 flex-1 flex-col text-gray-900">
                                <a href="#" class="line-clamp-1 font-semibold hover:underline">
                                    {{ $post->fullname }}
                                </a>

                                <a href="#" class="line-clamp-1 text-sm text-gray-500 hover:underline">
                                    {{ '@' . $post->username }}
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
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                    <!-- Dropdown menu -->
                                    <div x-show="open" @click.away="open = false"
                                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                        tabindex="-1">
                                        <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                                            tabindex="-1" id="user-menu-item-0">Edit</a>


                                        <form class="" action="{{ route('posts.destroy', ['post' => $post->id]) }}"
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
                <div class="py-4 font-normal text-gray-700">
                    <p>{!! nl2br(e($post->content)) !!}</p>
                </div>

                <!-- Date Created & View Stat -->
                <div class="my-2 flex items-center gap-2 text-xs text-gray-500">
                    <span class="">{{ $post->created_at->diffForHumans() }}</span>
                    <span class="">•</span>
                    <span>{{ $post->views }} views</span>
                </div>

            </article>
        </section>
        <!-- /Single post -->

    </main>
@endsection
