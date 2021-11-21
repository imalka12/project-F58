@extends('layouts.web.layout-email')

@section('disclaimer')
<div class="disclaimer">
  This email was sent to {{ $name }}.
  If you are not the intended receiver or you think this is a mistake, please
  contact us at <a href="mail-to:info@quickads.test" class="">info@quickads.test</a>
</div>
@endsection

@section('contents')
<h4>Your account deleted successfully.</h4>
<p>Hello {{ $name }},</p>
<p>This email remind you that your <strong>Quick Ads</strong> account deleted successfully.</p>
<p></p>
<p></p>
<p>Thanks!</p>
<p>Quick Ads Team</p>
@endsection