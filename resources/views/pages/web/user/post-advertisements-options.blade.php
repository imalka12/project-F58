@extends('layouts.web.master')

@section('custom-js')
@endsection

@section('custom-css')
@endsection

@section('contents')
    <div class="container p-5">
        <div class="col-lg-12">
            <a href="{{ route('client.profile') }}" class="btn btn-outline-primary float-end">Go back to profile</a>
        </div>
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-text">Edit Options for <span
                            class="text-success">{{ $advertisement->title }}</span></h4>

                    <form action="{{ route('client.advertisement.create-options-values', $advertisement->id) }}" method="POST">
                        @csrf

                        <div class="row">
                            @forelse ($options as $optionGroup)
                            <div class="col-lg-3">
                                <div class="mt-3">
                                    <label for="{{ $optionGroup->id }}"
                                        class="form-label">{{ $optionGroup->title }}</label>
                                    <select class="form-select" id="{{ $optionGroup->id }}"
                                        name="option_groups[{{ $optionGroup->id }}]" required>
                                        <option value="" selected>Select {{ $optionGroup->title }}</option>
                                        @foreach ($optionGroup->optionGroupValues as $optionValue)
                                            <option value="{{ $optionValue->id }}">{{ $optionValue->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @empty
                                <div class="col-lg-12">
                                    <div class="alert alert-info m-5">
                                        No selectable options available for the category.
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <div class="col-lg-12 mt-3">
                            <button type="submit" class="btn btn-primary" id="update_advertisement_options">Save and Proceed to Images</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
