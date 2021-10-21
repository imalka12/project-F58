@extends('layouts.web.master')

@section('contents')
    <div class="container p-3">
        <div class="row border-bottom">
            <div class="col-lg-3 border-end pt-3">
                <div class="input-group mb-3">
                    <span class="input-group-text bg-transparent border-0"><img
                            src="{{ asset('assets/images/website-icons/pin16.png') }}" alt="Location"></span>
                    <select name="city" id="city" class="form-select bg-transparent border-0 page-filter" style="cursor: pointer">
                        <option value="all" {{ $selectedCity->id == 0 ? 'selected' : '' }}>Sri Lanka</option>
                        @foreach ($cities as $district => $districtCities)
                            <optgroup label="{{ $district }} District">
                                @foreach ($districtCities as $city)
                                    <option value="{{ $city->id }}" {{ $selectedCity->id == $city->id ? 'selected' : '' }}>{{ $city->title }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-4 border-end pt-3">
                <div class="input-group mb-3">
                    <span class="input-group-text bg-transparent border-0"><img
                            src="{{ asset('assets/images/website-icons/tag16.png') }}" alt="Location"></span>
                    <select name="sub_category" id="sub_category" class="form-select bg-transparent border-0 page-filter"
                        style="cursor: pointer">
                        <option value="all">All Categories</option>
                        @foreach ($subCategories as $category)
                            <optgroup label="{{ $category['title'] }}">
                                @foreach ($category['subcategories'] as $subCategoryId => $subCategoryTitle)
                                    <option value="{{ $subCategoryId }}">{{ $subCategoryTitle }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="input-group mb-3 pt-3">
                    <input type="text" class="form-control" placeholder="What are you looking for?"
                        aria-label="What are you looking for?" aria-describedby="search-field">
                    <button class="btn btn-primary" type="submit" id="search-field">Search</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 border-end pt-3">
                <h5>Sort Results By</h5>
                <form action="" method="post">
                    <div class="mt-3 mb-3">
                        <select name="sort_key" id="sort_key" class="form-select page-filter">
                            <option value="date_newest">Date: Newest</option>
                            <option value="date_oldest">Date: Oldest</option>
                            <option value="price_high_to_low">Price: High to Low</option>
                            <option value="price_low_to_high">Price: Low to High</option>
                        </select>
                    </div>
                </form>

                <div class="border-top mb-3"></div>
                <h5>Sort Results By</h5>
                <div id="category_list_wrapper" class="mb-5">
                    <ul id="category_list_sidebar">
                        <li class="category_list_sidebar_link mb-2">
                            <a href="{{ route('ads.all') }}" class="d-block clearfix"> All Categories
                            </a>
                        </li>
                        @foreach ($categories as $parentCategory)
                            <li class="category_list_sidebar_link mb-2">
                                <a href="{{ route('ads.category.single', $parentCategory->id) }}"
                                    class="d-block clearfix">
                                    <span class="float-start">
                                        <img src="{{ asset('assets/images/category-icons/24/' . $parentCategory->icon) }}"
                                            alt="{{ $parentCategory->title }}" class="me-1">
                                        {{ $parentCategory->title }}
                                    </span>
                                    <span class="badge bg-light text-dark float-end mt-1">14</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 pt-3">
                <h4>Buy, Sell, Rent or Find Anything in {{ $selectedCity->title }}</h4>
                @if (!$advertisements->isEmpty())
                    <small class="text-muted">Showing 1-25 of {{ $advertisements->count() }} ads</small>
                @endif
                <div class="border-top mb-3 mt-3"></div>
                @forelse ($advertisements as $advertisement)
                    <div class="advertisement_block border rounded p-3 d-flex justify-content-start mb-3">
                        <div class="thumbnail border rounded">
                            <img src="{{ asset('storage/advs-images/' . $advertisement->advertisementImages->first()->image) }}"
                                alt="" width="100" height="100">
                        </div>
                        <div class="content ps-3">
                            <h4>{{ $advertisement->title }}</h4>
                            <p>{{ $advertisement->city->title }}, {{ $advertisement->subCategory->title }} <br/>
                                Rs. {{ number_format($advertisement->price, 2) }}<br />
                                <small class="text-muted">{{ $advertisement->payments->first()->created_at->diffForHumans()}}</small>
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="text-center p-5 mt-5">
                        <h2>No advertisements.</h2>
                    </div>
                @endforelse

                <div class="mt-3 d-flex justify-content-center">
                    {{ $advertisements->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-css')

@endsection

@section('custom-js')
    <script>
        let url = '{{ url()->current() }}';

        $('.page-filter').change(function(e) {
            let ar = [];

            let all = $('.page-filter');
            $.each(all, function(i, element) {
                let el = $(element);
                ar.push(el[0].id + '=' + escape(el[0].value));
            });

            let query = ar.join('&');
            window,location.replace(url + '?' + query);
        });
    </script>
@endsection
