@extends('layouts.portfolio-layout')

@section('content')
    <main>

        <div class="projects my-5">

            <h1 class="section-title my-5 text-center"> <strong>My Projects
                    <svg width="198" height="21" viewBox="0 0 198 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2 18.7327C13.8854 9.74093 29.4859 8.69377 43.6964 6.03115C65.1095 2.01897 86.6266 1.40829 108.405 2.01061C137.628 2.81881 166.558 7.3721 195.577 11.0296"
                            stroke="#FF5733" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </strong> & Applications</h1>

            <div>
                {{-- @php dd($categorizedProjects); @endphp --}}
                @foreach ($categorizedProjects as $category => $projects)
                    <h3 class="catagory fw-bolder mb-1 mt-5">{{ $category }}</h3>

                    <div class="row d-flex align-items-stretch">
                        @foreach ($projects as $project)
                            {{-- @php dd($projects); @endphp --}}

                            <div class="col-4 d-flex">
                                <a href="{{ route('projects.details', ['projectName' => $project->title]) }}"
                                    target="_blank" class="text-decoration-none">
                                    <div class="card project-card mx-auto mt-5">
                                        <div class="card-image">
                                            <div class="image-holder">
                                                <img src="{{ asset('images/projects/' . $project->images . '/Picture001.png') }}"
                                                    alt="Project image" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @foreach ($project->techs as $tech)
                                                <span
                                                    class="badge bg-light-pink text-uppercase fw-bold">{{ $tech }}</span>
                                            @endforeach
                                            <h4 class="card-title mb-1 mt-3">{{ $project->title }}</h4>
                                            <p class="card-short-description mb-1">{{ $project->intro }}</p>
                                            <p class="card-year mb-1">Date: {{ $project->date }}</p>
                                            <a href="{{ route('projects.details', ['projectName' => $project->title]) }}"
                                                class="text-bold">View Details</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endforeach






            </div>


        </div>

    </main>
@endsection
