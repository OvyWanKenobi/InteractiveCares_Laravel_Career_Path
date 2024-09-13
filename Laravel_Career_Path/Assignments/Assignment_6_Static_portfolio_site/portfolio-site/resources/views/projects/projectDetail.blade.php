@extends('layouts.portfolio-layout')

@section('content')
    <main>




        <!-- PROJECTS -->
        <section class="project-details pb-3 pt-4" id="project-details">
            <div class="container">


                <div class="d-flex flex-column align-items-center mx-auto text-center">

                    <h1 class="section-title my-5 text-center"> <strong>Project
                            <svg width="198" height="21" viewBox="0 0 198 21" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2 18.7327C13.8854 9.74093 29.4859 8.69377 43.6964 6.03115C65.1095 2.01897 86.6266 1.40829 108.405 2.01061C137.628 2.81881 166.558 7.3721 195.577 11.0296"
                                    stroke="#FF5733" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </strong> Overview</h1>


                    <div class="mx-auto my-5">
                        <div class="row">
                            <div class="col-4 px-4 py-5" style="background-color: rgba(218, 218, 218, 0.575)">
                                <h2 class="project-title text-uppercase">{{ $projectDetail->title }}</h2>
                                <p class="project-brief text-capitalize font-italic">{{ $projectDetail->intro }}
                                </p>
                                <p class="project-techs text-capitalize text-left"><strong>Techs & Tools used : </strong>
                                    {{ implode(', ', $projectDetail->techs) }}
                                </p>

                                <p class="project-site-link text-capitalize text-left"><strong>Worked On : </strong>
                                    {{ $projectDetail->date }}
                                </p>

                                @if ($projectDetail->siteLink)
                                    <p class="project-site-link text-capitalize text-left"><strong>Visit Live Site :
                                        </strong> <a class="icon-link icon-link-hover"
                                            href="{{ $projectDetail->siteLink }}">
                                            <i class="bi bi-link-45deg"></i> Click Here

                                        </a></p>
                                @endif
                                @if ($projectDetail->codeLink)
                                    <p class="project-code-link text-capitalize text-left"><strong>Access Codes : </strong>
                                        @if ($projectDetail->codeLink === 'classified')
                                            <span style="color: rgb(179, 58, 58); font-weight:600;"> CLASSIFIED</span>
                                        @else
                                            <a class="icon-link icon-link-hover" href="{{ $projectDetail->codeLink }}">
                                                <i class="bi bi-link-45deg"></i> Click Here

                                            </a>
                                        @endif


                                    </p>
                                @endif
                                @if ($projectDetail->videoLink)
                                    <p class="project-video-link text-capitalize text-left"><strong>Video Presentation :
                                        </strong>
                                        <a class="icon-link icon-link-hover" href="{{ $projectDetail->videoLink }}">
                                            <i class="bi bi-link-45deg"></i> Click Here

                                        </a>
                                    </p>
                                @endif
                                @if ($projectDetail->manualLink)
                                    <p class="project-manual-link text-capitalize text-left"><strong>User Manual :
                                        </strong>
                                        <a class="icon-link icon-link-hover" href="{{ $projectDetail->manualLink }}">
                                            <i class="bi bi-link-45deg"></i> Click Here

                                        </a>
                                    </p>
                                @endif
                            </div>
                            <div class="col-8 d-flex flex-column align-items-center p-4 text-left">
                                {{-- <p>Description</p> --}}
                                <p class="project-description">{!! $projectDetail->description !!}</p>
                            </div>
                        </div>

                    </div>
                    <h2 class="text-capitalize mt-4">Here are some previews of the project</h2>
                    <div class="col-8 owl-carousel owl-theme">

                        @foreach ($images as $image)
                            <div class="item">
                                <img src="{{ asset('images/projects/' . $image) }}" class="img-fluid" alt="project image">
                            </div>
                        @endforeach


                    </div>

                </div>

            </div>
        </section>


    </main>
@endsection
