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
<h4>Reset Your Password</h4>
<p>Hello {{ $user->firstname }},</p>
<p>The password for your account with <strong>Quick Ads</strong> has been requested to be reset.</p>
<p>Please note that this action will automatically expire in 60 minutes time.</p>
<p>Click the link below to reset your password.</p>
<div class="link-block"><a href="{{ $url }}" class="link">Click to Reset</a></div>
<p>
  If you have trouble using the link above, copy and paste the plain text URL below, in
  the URL bar of a new tab on your web browser and press ENTER to proceed.
</p>
<p>If you didn't request a password reset, please contact us immediately 
    at <a href="mail-to:info@quickads.test" class="">info@quickads.test</a> 
    and change your password to secure your account.</p>
<div class="email-link">
  <pre>{{ $url }}</pre>
</div>
@endsection