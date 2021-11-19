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
<h4>Confirm Your Account Deletion</h4>
<p>Hello {{ $user->firstname }},</p>
<p>Your account with <strong>Quick Ads</strong> has been requested to be deleted.</p>
<p>Please note that deleting your account will remove all your ads and all your data.</p>
<p>We regret you leaving our website, but hope you will return soon.</p>
<p>Click the link below to confirm deleting your account.</p>
<div class="link-block"><a href="{{ $url }}" class="link">Click to confirm</a></div>
<p>
  If you have trouble using the link above, copy and paste the text below to
  the URL bar of a new tab on your web browser and press ENTER to proceed.
</p>
<p>If you didn't request an account deletion, please contact us immediately 
    at <a href="mail-to:info@quickads.test" class="">info@quickads.test</a> 
    and change your password to secure your account.</p>
<div class="email-link">
  <pre>{{ $url }}</pre>
</div>
@endsection