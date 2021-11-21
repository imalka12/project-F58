@extends('layouts.web.master')

@section('contents')
    <div class="container p-3">
        <div class="row border-bottom">
            <div class="col-lg-3 border-end pt-3">
                <div class="input-group mb-3">
                    <span class="input-group-text bg-transparent border-0"><img
                            src="{{ asset('assets/images/website-icons/pin16.png') }}" alt="Location"></span>
                    <select name="city" id="city" class="form-select bg-transparent border-0 page-filter"
                        style="cursor: pointer">
                        <option value="all" {{ $selectedCity->id == 0 ? 'selected' : '' }}>Sri Lanka</option>
                        @foreach ($cities as $district => $districtCities)
                            <optgroup label="{{ $district }} District">
                                @foreach ($districtCities as $city)
                                    <option value="{{ $city->id }}"
                                        {{ $selectedCity->id == $city->id ? 'selected' : '' }}>{{ $city->title }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-4 border-end pt-3">
                <div class="input-group mb-3">
                    <span class="input-group-text bg-transparent border-0"><img
                            src="{{ asset('assets/images/website-icons/tag16.png') }}" alt="Category"></span>
                    <select name="sub_category" id="sub_category" class="form-select bg-transparent border-0 page-filter"
                        style="cursor: pointer">
                        <option value="all" {{ $selectedSubCategory->id == 0 ? 'selected' : '' }}>All
                            {{ Str::plural($category->title) }}</option>
                        @foreach ($subCategories as $subCategory)
                            <option value="{{ $subCategory->id }}"
                                {{ $selectedSubCategory->id == $subCategory->id ? 'selected' : '' }}>
                                {{ $subCategory->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-5">
                <form action="{{ url()->current() }}" method="get" id="ads-search-form">
                    <div class="input-group mb-3 pt-3">
                        @if($selectedCity->id != 0) 
                        <input type="hidden" name="city" value="{{ $selectedCity->id }}">
                        @endif
                        @if($selectedSubCategory->id != 0)
                        <input type="hidden" name="sub_category" value="{{ $selectedSubCategory->id }}">
                        @endif
                        <input type="text" class="form-control" placeholder="What are you looking for?"
                            aria-label="What are you looking for?" aria-describedby="search" id="search" name="search">
                        <button class="btn btn-primary" type="submit" id="search-field">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 border-end pt-3">
                <h5>Sort Results By</h5>
                <form action="" method="post">
                    <div class="mt-3 mb-3">
                        <select name="sort_key" id="sort_key" class="form-select page-filter">
                            @foreach ($sortKeys as $key => $value)
                            <option value="{{ $key }}" {{ $selectedSortKey == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>

                <div class="border-top mb-3"></div>

                <h5>Sort Results By</h5>
                <div id="category_list_wrapper" class="mb-5">
                    <ul id="category_list_sidebar">
                        <li class="category_list_sidebar_link mb-2">
                            <a href="{{ route('ads.all', ['city' => $selectedCity->id]) }}" class="d-block clearfix"> All
                                Categories
                            </a>
                        </li>
                        @foreach ($categoriesWithAdsCount as $parentCategory)
                            <li class="category_list_sidebar_link mb-2">
                                <a href="{{ route('ads.category.single', [$parentCategory->id, 'city' => $selectedCity->id, 'sort_key' => $selectedSortKey]) }}"
                                    class="d-block clearfix {{ $category->id === $parentCategory->id ? 'text-success' : '' }}">
                                    <span class="float-start">
                                        <img src="{{ asset('assets/images/category-icons/24/' . $parentCategory->icon) }}"
                                            alt="{{ $parentCategory->title }}" class="me-1">
                                        {{ $parentCategory->title }}
                                    </span>
                                    <span class="badge bg-light text-dark float-end mt-1">{{ $parentCategory->ads_count }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                @isset($optionFilters)
                @if($optionFilters->isNotEmpty())
                    <h5>Filter Results By</h5>
                        @foreach($optionFilters as $option)
                            @if($option->optionGroupValues->isNotEmpty())
                            <div class="mb-2">
                                <label for="option_{{ $option->id }}" class="form-label">{{ $option->title }}</label>
                                <select name="option_{{ $option->id }}" id="option_{{ $option->id }}" class="form-control option-filter" 
                                    data-slug="{{ $option->slug }}">
                                    <option value="">Select {{ $option->title }}</option>

                                    @foreach ($option->optionGroupValues as $optionGroupValue)
                                        <option value="{{ $optionGroupValue->id }}" 
                                            @if($filters)
                                                @isset($filters[$option->slug])
                                                    {{ ($filters[$option->slug] == $optionGroupValue->id) ? 'selected' : '' }}
                                                @endisset
                                            @endif
                                            >{{ $optionGroupValue->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                        @endforeach
                        <div class="mb-2">
                            <button class="btn btn-success w-100" id="filter_by_option_values">Filter Search</button>
                        </div>
                    @endif
                @endisset
            </div>
            <div class="col-lg-9 pt-3">
                <h4>Buy, Sell, Rent or Find <span class="text-primary">{{ $selectedSubCategory->title }}</span> in
                    <span class="text-success">{{ $selectedCity->title }}</span>
                </h4>
                @if (!$advertisementsByCategory->isEmpty())
                    <small class="text-muted">Showing 1-25 of {{ $advertisementsByCategory->count() }} ads</small>
                @endif
                <div class="border-top mb-3 mt-3"></div>
                @forelse ($advertisementsByCategory as $advertisement)
                    <a class="adv-link" href="{{ route('ads.view.single', $advertisement->id) }}" style="text-decoration: none;">
                        <div class="advertisement_block border rounded p-3 d-flex justify-content-start mb-3">
                            <div class="thumbnail border rounded">
                                <img src="{{ asset('storage/advs-images/' . $advertisement->advertisementImages->first()->image) }}"
                                    alt="" width="100" height="100">
                            </div>
                            <div class="content ps-3">
                                <h4>{{ $advertisement->title }}</h4>
                                <p>{{ $advertisement->city->title }}, {{ $advertisement->subCategory->title }} <br />
                                    Rs. {{ number_format($advertisement->price, 2) }}<br />
                                    <small>{{ $advertisement->payments->first()->created_at->diffForHumans() }}</small>
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="text-center p-5 mt-5">
                        <div class="mb-5">
                            <img src="{{ asset('assets/images/category-icons/64/' . $category->icon) }}"
                                alt="{{ $category->title }}" class="me-1">
                        </div>
                        @if (empty($searchStr))
                        <h2>No advertisements.</h2>
                        @else
                        <h2>No advertisements found matching <span class="text-secondary">&quot;{{ $searchStr }}&quot;</span>.</h2> 
                        @endif
                    </div>
                @endforelse

                <div class="mt-3 d-flex justify-content-center">
                    {{ $advertisementsByCategory->links() }}
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
            window, location.replace(url + '?' + query);
        });

        $('#filter_by_option_values').click(function(e) {
            let ar = [];

            let pf = $('.page-filter');
            $.each(pf, function(i, element) {
                let el = $(element);
                ar.push(el[0].id + '=' + escape(el[0].value));
            });

            let ofs = $('.option-filter');
            $.each(ofs, function(i, element) {
                let el = $(element);
                if(el.val() != '') {
                    ar.push('f_' + el.data('slug') + '=' + escape(el.val()));
                }
            });

            // add filters applied flag
            ar.push('filter=1');

            let query = ar.join('&');
            window, location.replace(url + '?' + query);
        });
    </script>
@endsection
