@extends('layouts.web.layout-email')

@section('disclaimer')
<div class="disclaimer">
  This email was sent to
  <a href="mail-to:{{ $user->email }}">{{ $user->firstname }} {{ $user->lastname }}</a>.
  If you are not the intended receiver or you think this is a mistake, please
  contact us at
  <a href="mail-to:info@quickads.test" class="">info@quickads.test</a>
</div>
@endsection

@section('contents')
<h4>Verify your email address</h4>
<p>Hello {{ $user->firstname }},</p>
<p>Your account with <strong>Quick Ads</strong> has been created.</p>
<p>
  Thank you for registering with us. We provide the easiest and most
  affordable way of online advertising on the internet. With our service,
  you can easily put advertisements without any hazzle.
</p>
<p>Click the link below to verify your email address.</p>
<div class="link-block"><a href="{{ $url }}" class="link">Click to verify</a></div>
<p>
  If you have trouble using the link above, copy and paste the text below to
  the URL bar of a new tab on your web browser and press ENTER to proceed.
</p>
<div class="email-link">
  <pre>{{ $url }}</pre>
</div>
@endsection