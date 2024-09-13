@extends('layouts.portfolio-layout')

@section('content')
    <main>


        <!-- HERO -->
        <section class="about full-screen d-lg-flex justify-content-center align-items-center" id="about">
            <div class="container">
                <div class="row">

                    <div class="col-lg-8 col-md-12 col-12 d-flex align-items-center">
                        <div class="about-text">
                            <small class="small-text">Welcome to <span class="mobile-block">my portfolio
                                    website!</span></small>
                            <h1 class="mb-3">
                                <span class="mr-2">Hello, I'm <span class="text-capitalize"
                                        style="color: #ff1e00d9; text-shadow: 1px 2px #ffffff; ">{{ $myInfo->fullName }}<span>
                                        </span>

                            </h1>
                            <h2 class="animated animated-text">
                                <span class="mr-2">A </span>
                                <div class="animated-info">
                                    @foreach ($myInfo->professions as $profession)
                                        <span class="animated-item text-capitalize">{{ $profession }}</span>
                                    @endforeach


                                </div>
                            </h2>

                            <p class="text-capitalize" style="width: 80%;">Building successful products is both my passion
                                and challenge. With high energy and creativity, I transform ideas into robust, user-centric
                                solutions. My curiosity drives continuous learning, ensuring impactful and innovative
                                results.</p>

                            <div class="custom-btn-group mt-4">
                                <a href="{{ asset('RESUME (OUTDATED) - ASHIQUR RAHMAN .pdf') }}"
                                    class="btn mr-lg-2 custom-btn"><i class='uil uil-file-alt'></i> Download
                                    Resume</a>
                                <a href="#contact" class="btn custom-btn custom-btn-bg custom-btn-link">Say Hello</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 col-12">
                        <div class="about-image">
                            <div class="profile-image-holder">
                                <img src="{{ asset('images/others/aaa2.png') }}" class="img-fluid profile-image"
                                    alt="Profile Image">
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>




        <!--================== MY story ==================-->
        <section class="about-me has-bg-color">
            <div class="container">
                <div class="row justify-content-center align-items-center d-flex flex-wrap">
                    <div class="about-me-stats col-md-4 px-2">
                        <div class="d-flex justify-content-center me-4" data-aos="fade-right" data-aos-duration="1500">
                            <h1 class="section-title"> Hear My<strong> Story
                                    <svg width="198" height="21" viewBox="0 0 198 21" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M2 18.7327C13.8854 9.74093 29.4859 8.69377 43.6964 6.03115C65.1095 2.01897 86.6266 1.40829 108.405 2.01061C137.628 2.81881 166.558 7.3721 195.577 11.0296"
                                            stroke="#FF5733" stroke-width="3" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </strong></h1>
                        </div>
                        <div class="d-flex justify-content-center">

                            @if ($myInfo->socials)
                                @foreach ($myInfo->socials as $social => $link)
                                    @if ($link)
                                        <a class="mx-3" href="{{ $link }} " target="_blank"><i
                                                class="bi bi-{{ $social }}"></i></a>
                                    @endif
                                @endforeach
                            @endif


                        </div>


                        <div class="stats row justify-content-center mt-4 px-2">
                            <div class="col-md-6 border-red border-right p-3 text-center">
                                <span class="number">{{ $myInfo->stats->techsLearned }}+</span>
                                <p>Techs & Tools Learned</p>
                            </div>
                            <div class="col-md-6 p-3 text-center">
                                <span class="number">{{ $myInfo->stats->stackExplored }}+</span>
                                <p>Stacks</p>
                            </div>

                            <div class="col-md-6 border-red border-right border-top p-3 text-center">
                                <span class="number">{{ $myInfo->stats->projectCompleted }}+</span>
                                <p>Projects Completed</p>
                            </div>
                            <div class="col-md-6 border-red border-top p-3 text-center">
                                <span class="number">{{ $myInfo->stats->yearExperience }}+</span>
                                <p>Years of Experience</p>
                            </div>

                        </div>


                    </div>
                    <div class="about-me-summary col-md-8 px-5" data-aos="fade-left" data-aos-duration="1500">
                        <p class="mb-1">Born and raised in the green metropolis of Chittagong, Bangladesh, where I
                            completed my A-levels from Mastermind International School. later moved to the bustling urban
                            capital, Dhaka to pursue my undergraduate degree in Computer Science & Engineering at American
                            International University, Bangladesh, where I secured myself a high CGPA. My
                            academic journey equipped me with the knowledge and skills that I would later apply in the
                            professional world.</p>
                        <p class="mb-1">Upon graduation, I began my career as a junior developer at HABRO SYSTEMS LIMITED,
                            a small company located in Gulshan-1, Dhaka. During my 8-month tenure, I had the opportunity to
                            develop two major live projects from scratch by myself with guidances from my supervisors. These
                            projects were recognized for their
                            exceptional user experience, highlighting my ability to deliver high-quality work.
                            Although being the best creative mind in a small team, I gained many new knowledges from my
                            valuable experience, as it marked my first involvement in live commercial projects.
                        </p>
                        <p class="mb-1">After gaining substantial experience, I chose to return to my comfortable
                            hometown. Along with supporting my father's business as a technical and managerial support, I
                            managed to continue my journey in computer science by dedicating myself in learning new web
                            technologies and engaging in researches in Machine Learning for publications, maintaining my
                            passion for innovation and improvement.</p>
                        <p class="mb-1">I am an aspiring learner with fluid intelligence, adept at adapting to challenging
                            situations and thriving under pressure. My ability to manage tight deadlines is a strength,
                            though my deep commitment to delivering the highest quality work sometimes leads me to exceed
                            those deadlines, as I treat every project as a work of art, striving to exceed expectations and
                            achieve a standard that brings me personal satisfaction.</p>

                    </div>
                    <div class="about-me-summary col-md-12 px-5" data-aos="fade-left" data-aos-duration="1500">
                        <p class="mb-1">I have an insatiable curiosity and a passion for learning anything that captures
                            my interest, though I'm often limited by time and energy. While others may focus on specializing
                            in one area, I prefer to explore diverse web stacks, aiming to be equipped with a broad skill
                            set and to have multiple options to choose the best from. Although this approach may have slowed
                            my progress in the conventional life race, but yet I carry no regrets, as spiritual fulfillment
                            is more important to me than conventional measures of success.</p>
                        <p class="mb-1">My personality reflects a blend of generational influences, making me a true
                            'zillenial'—a mix of Gen Z and Millennial traits. I am deeply driven by logic and tangible
                            results, which sometimes leads to conflicts with social norms. I recognize this tendency and am
                            working on balancing it. Additionally, I take my responsibilities to family, friends, and work
                            very seriously, ensuring I only take on commitments that I can fulfill effectively. This
                            approach helps me manage my responsibilities with care and integrity.</p>
                        <p class="mb-1">
                            In my spare time, I'm a dedicated cinephile, often spending twice as long on a movie or show, as
                            I analyze the work of directors and artists. I also have a passion for learning random trivia,
                            which makes me a go-to person for insights on topics ranging from history, religions, geography,
                            trends, culture, psychology, etc. Here I must quote Ragnar Lothbrok from the Vikings "Odin gave
                            his one eye to acquire knowledge.. but I would give far more". Except Modern Rap, I got a
                            versatile taste in music. Although I enjoyed traveling when
                            young, the distance barrier from friends and their busy lives often leaves me spending most of
                            my weeks in solitude.

                        </p>

                        <p class="mb-1">Looking ahead, as of 2024, my current goal is to complete my current learning by
                            this year, secure a role
                            that matches my skills, finalize my research and publications in machine learning, and apply for
                            a Master’s in Artificial Intelligence, aiming to contribute to the next wave of technological
                            advancements.</p>
                        <p class="mt-3 text-center" style="font-size: 16px; font-weight:600; "> -- FIN --</p>
                    </div>
                </div>
            </div>
        </section>
        <!--================== About me ==================-->

        <!--================== Service Section Start ==================-->
        <section class="services section">
            <div class="container">
                <div class="row mb-5 text-center">
                    <div class="col-lg-6 col-12 mx-auto">
                        <div class="section-title mb-md-4">
                            <h2>What I <strong> Know
                                    <svg width="198" height="21" viewBox="0 0 198 21" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M2 18.7327C13.8854 9.74093 29.4859 8.69377 43.6964 6.03115C65.1095 2.01897 86.6266 1.40829 108.405 2.01061C137.628 2.81881 166.558 7.3721 195.577 11.0296"
                                            stroke="#FF5733" stroke-width="3" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </strong></h2>
                        </div>
                    </div>
                </div>
                <div class="row g-4 justify-content-center">

                    @foreach ($services as $service)
                        <div class="col-lg-4 col-md-6 card-item">
                            <div class="card radius border-0 bg-white px-3 py-3 text-center shadow" data-aos="fade-right"
                                data-aos-duration="1500">
                                <div class="card-icon mb-1">
                                    <i class="{{ $service->icon }}"></i>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">{{ $service->title }}</h4>
                                    <p class="card-text small">{{ $service->summary }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach



                </div>
            </div>
        </section>
        <!--================== Service Section End ==================-->


        <div class="skills-section container">
            <h2 class="section-title text-center">Languages & <strong> Skills
                    <svg width="198" height="21" viewBox="0 0 198 21" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2 18.7327C13.8854 9.74093 29.4859 8.69377 43.6964 6.03115C65.1095 2.01897 86.6266 1.40829 108.405 2.01061C137.628 2.81881 166.558 7.3721 195.577 11.0296"
                            stroke="#FF5733" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </strong></h2>
            <p class="mb-5 text-center">Over the recent years, I've honed and continue to explore new tools and
                technologies. Below is a quick overview of my main technical skill sets and technologies I have explored. I
                have a passion for learning diverse stacks, driven by the belief that mastering many tools creates countless
                opportunities to apply them effectively.
            </p>

            <div class="row">


                @foreach ($skills as $skill)
                    <div class="col-md-6 col-lg-3">
                        <div class="skill-card">


                            @foreach ($skill->icons as $icon)
                                <img src="{{ $icon }}" alt="{{ $skill->title }} Icon">
                            @endforeach



                            <h4 class="title">{{ $skill->title }}</h4>
                            <p class="summary">{{ $skill->summary }}</p>
                            <p class="level">LEVEL: <strong>{{ $skill->level }}</strong> </p>
                        </div>
                    </div>
                @endforeach







            </div>
        </div>


    </main>
@endsection
