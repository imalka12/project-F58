@extends('layouts.master')

@section('title') Block Users @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Home @endslot
        @slot('title') Block Users @endslot
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                
            </div>
        </div>
    </div>

@endsection

@section('script')
@endsection
