@extends('layouts.web.layout-email')

@section('disclaimer')
<div class="disclaimer">
  This email was sent to {{ $name }}.
  If you are not the intended receiver or you think this is a mistake, please
  contact us at <a href="mail-to:info@quickads.test" class="">info@quickads.test</a>
</div>
@endsection

@section('contents')
<h4>Contact Request Received</h4>
<p>Hello {{ $name }},</p>
<p>Thank you for submitting your contact request to <strong>Quick Ads</strong>.</p>
<p>We received your submission and this is to confirm that we are looking into your message.</p>
<p>We will contact you at our earliest possible.</p>
<p>Thanks!</p>
<p>Quick Ads Team</p>
@endsection