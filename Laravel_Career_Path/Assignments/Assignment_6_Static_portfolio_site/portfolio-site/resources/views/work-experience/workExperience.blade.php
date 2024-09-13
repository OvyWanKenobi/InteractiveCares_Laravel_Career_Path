@extends('layouts.portfolio-layout')

@section('content')
    <main>
        <div class="experiences container my-5 px-4">

            <div class="row gx-5 justify-content-center">
                <div class="col-lg-11 col-xl-9 col-xxl-8">
                    <!-- Experience Section-->
                    <section>
                        <div class="d-flex align-items-center justify-content-between mb-4">

                            <h2 class="section-title my-3"> <i class="bi bi-briefcase-fill"></i> <strong>
                                    Experiences
                                    <svg width="198" height="21" viewBox="0 0 198 21" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M2 18.7327C13.8854 9.74093 29.4859 8.69377 43.6964 6.03115C65.1095 2.01897 86.6266 1.40829 108.405 2.01061C137.628 2.81881 166.558 7.3721 195.577 11.0296"
                                            stroke="#FF5733" stroke-width="3" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </strong> </h2>
                            <!-- Download resume button-->
                            <!-- Note: Set the link href target to a PDF file within your project-->
                            <a class="btn px-2 py-3" href="{{ asset('RESUME (OUTDATED) - ASHIQUR RAHMAN .pdf') }}">
                                <div class="d-inline-block bi bi-download me-2"></div>
                                Download Resume
                            </a>
                        </div>

                        @foreach ($experiences as $experience)
                            <!-- Experience Card-->

                            <div class="card rounded-4 mb-5 border-0 shadow">
                                <div class="card-body p-5">
                                    <div class="row align-items-center gx-5">
                                        <div class="col text-lg-start mb-lg-0 mb-4 text-center">
                                            <div class="bg-light rounded-4 p-4">
                                                <div class="time fw-bolder mb-2">{{ $experience->date }}</div>
                                                <div class="position fw-bolder">{{ $experience->position }}</div>
                                                <div class="company text-muted"><a
                                                        href="http://habrosystems.com/">{{ $experience->company }} </a>
                                                </div>
                                                <div class="location text-muted">
                                                    {{ $experience->address }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="experience-summary"> {{ $experience->summary }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach



                    </section>
                    <!-- Education Section-->
                    <section>

                        <h2 class="section-title my-5"> <i class="bi bi-mortarboard-fill me-3"></i><strong>
                                Education
                                <svg width="198" height="21" viewBox="0 0 198 21" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M2 18.7327C13.8854 9.74093 29.4859 8.69377 43.6964 6.03115C65.1095 2.01897 86.6266 1.40829 108.405 2.01061C137.628 2.81881 166.558 7.3721 195.577 11.0296"
                                        stroke="#FF5733" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </strong> </h2>

                        @foreach ($educations as $education)
                            <!-- Education Card-->
                            <div class="card rounded-4 mb-5 border-0 shadow">
                                <div class="card-body p-5">
                                    <div class="row align-items-center gx-5">
                                        <div class="col text-lg-start mb-lg-0 mb-4 text-center">
                                            <div class="bg-light rounded-4 p-4">
                                                <div class="time fw-bolder mb-2">{{ $education->date }}</div>
                                                <div class="position fw-bolder">{{ $education->program }}</div>
                                                <div class="company text-muted"><a
                                                        href="https://www.aiub.edu/faculties/fst/programs/under-graduate/bachelor-of-science-in-computer-science--engineering">{{ $education->institute }}
                                                    </a></div>

                                                <div class="location text-muted">{{ $education->address }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="experience-summary">{{ $education->summary }} </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach




                    </section>

                </div>
            </div>

        </div>

    </main>
@endsection
