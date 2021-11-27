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
                    @if ($submission->advertisement)
                        <div class="card">
                            <div class="card-header">
                                @if ($submission->advertisement->isExpired())
                                    <h6 class="text-warning">Expired at: {{ $submission->advertisement->expire_at }}</h6>
                                @endif

                                <h6 class="card-title">{{ $submission->reason }}</h6>
                                <h5 class="card-subtitle">Advertisement: {{ $submission->advertisement->title }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="message">
                                    <small>Report Comments: </small>
                                    <p>{!! nl2br($submission->comments) !!}</p>
                                </div>
                                <small>Received {{ $submission->created_at->diffForHumans() }}</small> <br>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('ads.view.single', $submission->advertisement_id) }}"
                                    class="btn btn-success" target="_blank">
                                    View
                                </a>

                                @if (!$submission->advertisement->isExpired())
                                    <form
                                        action="{{ route('admin.advertisement-force-expire', $submission->advertisement->id) }}"
                                        method="post" class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to force expire this advertisement?')">
                                        @csrf

                                        <button type="submit" class="btn btn-warning">Force Expire</button>
                                    </form>
                                @endif

                                <form
                                    action="{{ route('admin.advertisement-force-delete', $submission->advertisement->id) }}"
                                    method="post" class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to force delete this advertisement?')">
                                    @csrf

                                    <button type="submit" class="btn btn-danger">Force Delete</button>
                                </form>

                                <form action="{{ route('admin.advertisement-report-dismiss', $submission->id) }}"
                                    method="POST" class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this report?')">
                                    @csrf

                                    <button type="submit" class="btn btn-secondary">Dismiss report</button>
                                </form>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-center">No available reported advertisements to show.</h4>
                        </div>
                    </div>
                @endforelse

                @if (!empty($submissions))
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
