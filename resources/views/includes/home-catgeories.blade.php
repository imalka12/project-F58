<div class="container my-5">
    <div class="row">
        <div class="col-lg-12">
            <h4>Browse advertisements by category</h4>
        </div>
        @foreach ($categoriesWithAdsCount as $category)
        <div class="col-lg-4 col-md-4 col-sm-6">
            <a href="{{ route('ads.category.single', $category->id) }}" class="category_link">
                <div class="d-flex align-items-center p-4">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('assets/images/category-icons/64/' . $category->icon) }}" alt="{{ $category->title }}">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>{{ $category->title }}</h5>
                        <small>{{ $category->ads_count }} {{ $category->ads_count == 1 ? 'Advertisement' : 'Advertisements' }}</small>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
        </div>
    </div>