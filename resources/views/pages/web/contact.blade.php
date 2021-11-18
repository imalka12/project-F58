@extends('layouts.web.master')

@section('contents')
    <div class="container p-5">
        <div class="row">
            <div class="col-lg-12">
                <h1>Contact us</h1>
                <p>If you did not find the answer to your question or problem, please get in touch with us using the form
                    below and we will respond to your message as soon as possible.</p>

                <div class="row mt-5">
                    <div class="col-lg-12">
                        <div class="ratio ratio-21x9">
                            <iframe width="1200" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" id="gmap_canvas" src="https://maps.google.com/maps?width=1200&amp;height=400&amp;hl=en&amp;q=Puttalam%20Road%20Kurunegala+(Quick%20Ads%20Advertising)&amp;t=p&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe> <a href='https://embed-map.org/'>embed google maps</a> <script type='text/javascript' src='https://embedmaps.com/google-maps-authorization/script.js?id=6d566c329222b33308b08342cb6ef4ac50dba948'></script>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-lg-4">
                        <h2>Quick Ads Advertising</h2>
                        <address>
                            <strong>Address</strong>
                            <br>
                            Puttalam Road,
                            <br>
                            Kurunegala
                            <br>
                            Sri Lanka.
                        </address>

                        <address>
                            <strong>Telephone</strong>
                            <br>
                            0701234567
                            <br>
                            <strong>Email</strong>
                            <br>
                            <a href="mail-to:info@quickads.local">info@quickads.local</a>
                        </address>
                    </div>
                    <div class="col-lg-8">
                        <form action="{{ route('site.contact') }}" method="post">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-lg-10">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" placeholder="Your name" aria-label="name"
                                            id="name" name="name" required>
                                        <label for="name">
                                            Your Name <small>(required)</small>
                                        </label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="email" name="email" 
                                        placeholder="Your email address" required>
                                        <label for="email">Your Email <small>(required)</small></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" placeholder="Leave a comment here" id="message"
                                            name="message" style="height: 150px" required></textarea>
                                        <label for="message">
                                            Message <small>(required)</small>
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
