@extends('layouts.master')

@section('title') Reported Ads @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Home @endslot
        @slot('title') Reported Advertisements @endslot
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @forelse ($submissions as $submission)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Advertisement Id: {{ $submission->advertisement_id }}</h5>
                        <h6 class="card-subtitle">{{ $submission->reason }}</h6>
                        <div class="message mt-3">
                            <p>{!! nl2br($submission->comments) !!}</p>
                        </div>
                        <small>Received {{ $submission->created_at->diffForHumans() }}</small> <br>
                        <a href="{{ route('ads.view.single', $submission->advertisement_id) }}"
                            class="btn btn-success mt-3">
                            View
                        </a>
                    </div>
                </div>
                @empty
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-center">No available reported advertisements to show.</h4>
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
