@extends('layouts.web.master')

@section('contents')
    <div class="container p-3">
        <div class="row border-bottom pt-3">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('site.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('ads.all') }}">All Ads</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('ads.category.single', $advertisement->subCategory->category_id) }}">{{ $advertisement->subCategory->category->title }}</a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('ads.category.single', $advertisement->subCategory->category_id) }}?sub_category={{ $advertisement->sub_category_id }}">{{ $advertisement->subCategory->title }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $advertisement->title }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-12">
                <h1>{{ $advertisement->title }}</h1>
            </div>
            <div class="col-lg-9 mt-3">
                <div id="advertisement-images-carousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($advertisement->advertisementImages as $image)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img class="single-ad-carousel-image"
                                    src="{{ asset('storage/advs-images/' . $image->image) }}"
                                    alt="Image for {{ $advertisement->title }}">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#advertisement-images-carousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#advertisement-images-carousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="mt-3">
                    <h6 id="single_ad_price">Rs. {{ number_format($advertisement->price, 2) }}</h6>
                </div>
                <div class="mt-2">
                    @if(count($advertisement->advertisementOptions) > 0)
                        <div class="row">
                            @foreach ($advertisement->advertisementOptions as $option)
                            <div class="col-lg-6">
                                {{ $option->optionGroup->title }} : <strong>{{ $option->optionGroupValue->title }}</strong>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="mt-3">
                    <h6>Description</h4>
                    {!! $advertisement->description !!}
                </div>
            </div>
            <div class="col-lg-3 mt-3">
                <ul class="list-group">
                    <li class="list-group-item">
                        For sale by <strong>{{ $advertisement->user->firstname }}</strong>
                    </li>
                    <li class="list-group-item">
                        <span class="me-2">
                            <img src="{{ asset('assets/images/website-icons/telephone-call-32.png') }}" alt="" />
                        </span>
                        <span class="client-telephone">{{ $advertisement->user->profile->telephone }}</span>
                    </li>
                    <li class="list-group-item">
                        <small>Published on {{ $advertisement->publishedAt()->format('Y-m-d') }}</small>
                    </li>
                </ul>

                <a href="#" class="btn btn-warning text-white mt-2 w-100 d-block">Report this ad</a>
            </div>
        </div>
    </div>


@endsection

@section('custom-css')

@endsection

@section('custom-js')

@endsection
