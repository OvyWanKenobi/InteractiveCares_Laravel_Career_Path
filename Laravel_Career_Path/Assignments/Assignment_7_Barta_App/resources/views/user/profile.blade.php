@extends('layouts.app')

@section('main-contents')
    <main class="container mx-auto mt-8 min-h-screen max-w-2xl space-y-8 px-2">
        <!-- Cover Container -->
        <section
            class="flex min-h-[400px] flex-col items-center justify-center space-y-8 rounded-xl border-2 border-gray-800 bg-white p-8">
            <!-- Profile Info -->
            <div class="flex flex-col items-center justify-center gap-4 text-center">


                <!-- User Meta -->
                <div>
                    <h1 class="font-bold md:text-2xl">{{ $user['fullname'] }}</h1>
                    <p class="text-gray-700"> {!! $user['bio'] ?? '<em>add a bio</em>' !!} </p>
                </div>
                <!-- / User Meta -->
            </div>


            <!-- Edit Profile Button (Only visible to the profile owner) -->
            <a href="{{ route('edit-profile') }}" type="button"
                class="-m-2 flex items-center gap-2 rounded-full bg-gray-100 px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                </svg>

                Edit Profile
            </a>
            <!-- /Edit Profile Button -->
        </section>

    </main>
@endsection
