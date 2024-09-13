<!-- MENU -->
<nav class="navbar navbar-expand-sm navbar-light">
    <div class="container">

        <div class="navbar-brand"><a href="{{ route('home') }}" class="top-bar-name">{{ $myInfo->fullName }}</a></div>
        {{-- <a class="navbar-brand" href="mailto:{{$myInfo->email}}">
            Ashiqur Rahman</a> --}}

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link"><span data-hover="Home">Home</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('experiences') }}" class="nav-link"><span
                            data-hover="Experience">Experience</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('projects') }}" class="nav-link"><span data-hover="Projects">Projects</span></a>
                </li>
                <li class="nav-item">
                    <a href="#contact" class="nav-link"><span data-hover="Contact">Contact</span></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-lg-auto">
                <div class="ml-lg-4">

                    <div class="d-flex flex-column justify-content-end">
                        <a class="navbar-brand top-bar-mail" href="mailto:{{ $myInfo->email }}"><i
                                class='bi bi-envelope'></i>{{ $myInfo->email }}
                        </a>
                        <a class="navbar-brand top-bar-mail" href="tel: {{ $myInfo->whatsapp }}"><i
                                class='bi bi-whatsapp'></i>{{ $myInfo->whatsapp }}
                        </a>
                    </div>



                    {{-- <div class="color-mode d-lg-flex justify-content-center align-items-center">
                        <i class="color-mode-icon"></i>
                        Color mode
                    </div> --}}
                </div>
            </ul>
        </div>
    </div>
</nav>
