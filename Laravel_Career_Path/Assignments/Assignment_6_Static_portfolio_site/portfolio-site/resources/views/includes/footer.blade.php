<!-- CONTACT -->
<section class="contact mt-5 py-5" id="contact">
    <div class="container">
        <div class="row">

            <div class="col-lg-5 mr-lg-5 col-12">


                <div class="contact-info d-flex flex-column">
                    <h2 class="site-footer-title d-block mb-3">Get In Touch</h2>



                    <strong class="mb-2 mt-3">Email</strong>

                    <p class="mb-0">
                        <a href="mailto:{{ $myInfo->email }}">
                            {{ $myInfo->email }}
                        </a>
                    </p>

                    <strong class="mb-2 mt-2">WhatsApp</strong>

                    <p class="mb-0">
                        <a href="tel: {{ $myInfo->whatsapp }}">
                            {{ $myInfo->whatsapp }}
                        </a>
                    </p>


                    <strong class="mb-2 mt-2">Location</strong>

                    <p class="mb-0">
                        <a href="#">
                            {{ $myInfo->address }}
                        </a>
                    </p>

                    <strong class="site-footer-title d-block mb-2 mt-4">Stay connected</strong>
                    <ul class="social-icon d-flex">


                        @if ($myInfo->socials)
                            @foreach ($myInfo->socials as $social => $link)
                                @if ($link)
                                    <li class="social-icon-item"><a href="{{ $link }}"
                                            class="social-icon-link bi-{{ $social }}" target="_blank"></a></li>
                                @endif
                            @endforeach
                        @endif


                    </ul>

                </div>
            </div>

            <div class="col-lg-6 col-12">
                <div class="contact-form">
                    <h2 class="mb-4">Interested to work together? Let's talk</h2>

                    <form action="#" method="#">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <input type="text" class="form-control" name="name" placeholder="Your Name"
                                    id="name">
                            </div>

                            <div class="col-lg-6 col-12">
                                <input type="email" class="form-control" name="email" placeholder="Email"
                                    id="email">
                            </div>

                            <div class="col-12">
                                <textarea name="message" rows="6" class="form-control" id="message" placeholder="Message"></textarea>
                            </div>

                            <div class="ml-lg-auto col-lg-5 col-12">
                                <input type="submit" class="form-control submit-btn" value="Send Button" disabled>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>



<!-- FOOTER -->
<footer class="footer py-5">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12">
                <p class="copyright-text text-center">Copyright &copy; Ashiqur Rahman . All rights reserved</p>

            </div>

        </div>
    </div>
</footer>
