@extends('layouts.portfolio-layout')

@section('content')
    <main>
        <div class="error-page container">
            <h1>Oops! Something went wrong.</h1>
            <p>We are working to fix this. Please try again later.</p>
            <a href="{{ route('home') }}">Go back to Home</a>
        </div>
    </main>
@endsection
