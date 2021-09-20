@extends('layouts.web.master')

@section('contents')
    <div class="container p-5">
        <div class="row">
            <div class="col-lg-12">
                <h1>Contact us</h1>
                <p>If you did not find the answer to your question or problem, please get in touch with us using the form
                    below and we will respond to your message as soon as possible.</p>
                
                    <form>
                    <div class="row justify-content-center">
                    <div class="col-lg-10">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="City" aria-label="City" id="floatingTextarea">
                        <label for="floatingTextarea">Your Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Your Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 150px"></textarea>
                        <label for="floatingTextarea">Message</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
