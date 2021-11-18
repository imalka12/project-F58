@extends('layouts.master')

@section('title') Contact Form Submissions @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Home @endslot
        @slot('title') Contact Form Submissions @endslot
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @forelse ($submissions as $submission)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $submission->name }}</h5>
                        <h6 class="card-subtitle">{{ $submission->email }}</h6>
                        <div class="message mt-3">
                            <p>{!! nl2br($submission->message) !!}</p>
                        </div>
                        <small>Received {{ $submission->created_at->diffForHumans() }}</small>
                    </div>
                </div>
                @empty
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-center">No contact form submissions available to show.</h4>
                        </div>
                    </div>
                @endforelse

                @if (! empty($submissions))
                    {{ $submissions->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/libs/datatables/datatables.min.css') }}">
@endsection

@section('script')
<script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
<script>
    $('#contact-form-submissions-table').DataTable();
</script>
@endsection
