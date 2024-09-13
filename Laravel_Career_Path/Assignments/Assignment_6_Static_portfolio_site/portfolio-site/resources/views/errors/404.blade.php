@extends('layouts.portfolio-layout')

@section('content')
    <main>
        <div class="container error-page" >
            <h2>Oops! 404 - Page Not Found</h2>
            <p>The page you're looking for doesn't exist.</p>
            <a href="{{ route('home') }}">Go back to Home</a>
        </div>
    </main>
@endsection
