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

        @if (session('message'))
            <script>
                alert('{{ session('message') }}');
            </script>
        @endif


        <!-- Single post -->
        <section id="newsfeed" class="space-y-6">
            <article class="mx-auto max-w-none rounded-lg border-2 border-black bg-white px-4 py-5 shadow sm:px-6">
                <!-- Barta Card Top -->
                <header>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">

                            <!-- User Avatar -->
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full object-cover"
                                    src="{{ $post->user->profile_picture_img }}" alt="{{ $post->user->fullname }}" />
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
                    @if ($post->post_image_file)
                        <img src="{{ $post->post_image_file }}"
                            class="min-h-auto max-h-64 rounded-lg object-cover md:max-h-72" alt="post image" />
                    @endif

                </div>

                <!-- Date Created & View Stat -->
                <div class="my-2 flex items-center gap-2 text-xs text-gray-500">
                    <span class="">{{ $post->created_at->diffForHumans() }}</span>
                    <span class="">•</span>
                    <span>{{ count($post->comments) }} comments</span>
                    <span class="">•</span>
                    <span>{{ $post->views }} views</span>
                </div>
                <hr class="my-6" />

                <!-- Barta Create Comment Form -->
                <form action="{{ route('comments.store') }}" method="POST" novalidate>
                    @csrf

                    <input type="hidden" name="postId" value="{{ $post->id }}">

                    <!-- Create Comment Card Top -->
                    <div>
                        <div class="/space-x-3/ items-start">
                            <!-- User Avatar -->
                            <!-- <div class="flex-shrink-0">-->
                            <!--              <img-->
                            <!--                class="h-10 w-10 rounded-full object-cover"-->
                            <!--                src="https://avatars.githubusercontent.com/u/831997"-->
                            <!--                alt="Ahmed Shamim" />-->
                            <!--            </div> -->
                            <!-- /User Avatar -->

                            <!-- Auto Resizing Comment Box -->
                            <div class="w-full font-normal text-gray-700">
                                <textarea x-data="{
                                    resize() {
                                        $el.style.height = '0px';
                                        $el.style.height = $el.scrollHeight + 'px'
                                    }
                                }" x-init="resize()" @input="resize()" type="text" name="comment"
                                    placeholder="Write a comment..."
                                    class="border-sm ring-offset-background flex h-auto min-h-[40px] w-full rounded-lg border border-neutral-300 bg-gray-100 px-3 py-2 text-sm text-gray-900 placeholder:text-neutral-400 focus:border-neutral-300 focus:bg-white focus:outline-none focus:ring-1 focus:ring-neutral-400 focus:ring-offset-0 disabled:cursor-not-allowed disabled:opacity-50">{{ old('comment') }}</textarea>
                            </div>

                            <div class="mt-2 text-sm text-red-500">
                                @error('comment')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Create Comment Card Bottom -->
                    <div>
                        <!-- Card Bottom Action Buttons -->
                        <div class="flex items-center justify-end">
                            <button type="submit"
                                class="mt-2 flex items-center gap-2 rounded-full bg-gray-800 px-4 py-2 text-xs font-semibold text-white hover:bg-black">
                                Comment
                            </button>
                        </div>
                        <!-- /Card Bottom Action Buttons -->
                    </div>
                    <!-- /Create Comment Card Bottom -->
                </form>
                <!-- /Barta Create Comment Form -->

            </article>

            <hr />
            <div class="flex flex-col space-y-6">
                <h1 class="text-lg font-semibold">Comments ({{ count($post->comments) }})</h1>

                @if (!empty($post->comments) && count($post->comments) > 0)
                    <!-- Barta User Comments Container -->
                    <article
                        class="mx-auto min-w-full max-w-none divide-y rounded-lg border-2 border-black bg-white px-4 py-2 shadow sm:px-6">
                        <!-- Comments -->


                        @foreach ($post->comments as $comment)
                            <div class="py-4">
                                <!-- Barta User Comments Top -->
                                <header>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">

                                            <!-- User Avatar -->
                                            <div class="flex-shrink-0">
                                                <img class="h-10 w-10 rounded-full object-cover"
                                                    src="{{ $comment->user->profile_picture_img }}"
                                                    alt="{{ $comment->user->fullname }}" />
                                            </div>
                                            <!-- /User Avatar -->


                                            <!-- User Info -->
                                            <div class="flex min-w-0 flex-1 flex-col text-gray-900">
                                                <a href="{{ route('profile', ['user' => $comment->user->username]) }}"
                                                    class="line-clamp-1 font-semibold hover:underline">
                                                    {{ $comment->user->fullname }}
                                                </a>

                                                <a href="{{ route('profile', ['user' => $comment->user->username]) }}"
                                                    class="line-clamp-1 text-sm text-gray-500 hover:underline">
                                                    {{ '@' . $comment->user->username }}
                                                </a>
                                            </div>
                                            <!-- /User Info -->


                                        </div>


                                        @if ($comment->user_id === auth()->user()->id)
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
                                                        <a href="{{ route('comments.edit', ['comment' => $comment->id]) }}"
                                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                            role="menuitem" tabindex="-1" id="user-menu-item-0">Edit</a>


                                                        <form class=""
                                                            action="{{ route('comments.destroy', ['comment' => $comment->id]) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Are you sure you want to delete this comment?');"
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
                                    <p>{!! nl2br(e($comment->comment)) !!}</p>
                                </div>

                                <!-- Date Created -->
                                <div class="flex items-center gap-2 text-xs text-gray-500">
                                    <span class="">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @endforeach

                        <!-- /Comments -->
                    </article>
                @endif
                <!-- /Barta User Comments -->


            </div>




        </section>


        <!-- /Single post -->

    </main>
@endsection
