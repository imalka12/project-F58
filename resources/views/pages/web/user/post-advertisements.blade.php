@extends('layouts.web.master')

@section('custom-js')
    <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
    <script>
    if (ClassicEditor) {
        ClassicEditor.create(document.querySelector(".ckeditor-editor"))
            .then((editor) => {
                console.log(editor);
            })
            .catch((error) => {
                console.error(error);
            });
    }
    </script>
@endsection

@section('custom-css')

@endsection

@section('contents')
    <div class="container p-5">
        <div class="row">
            <div class="col-lg-12">
                <a href="{{ route('client.profile') }}" class="btn btn-outline-primary float-end">Go back to profile</a>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('client.advertisement.create') }}" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="sub_category_id" class="form-label">Category</label>
                                        <select name="sub_category_id" id="sub_category_id" class="form-control">
                                            @foreach ($categories as $category)
                                                <optgroup label="{{ $category['title'] }}">
                                                    @foreach ($category['subcategories'] as $subCategoryId => $subCategoryTitle)
                                                        <option value="{{ $subCategoryId }}">{{ $subCategoryTitle }}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="city_id" class="form-label">Location</label>
                                        <select name="city_id" id="city_id" class="form-control">
                                            @foreach ($cities as $district => $districtCities)
                                                <optgroup label="{{ $district }}">
                                                    @foreach ($districtCities as $city)
                                                        <option value="{{ $city->id }}">{{ $city->title }}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Enter item title here. Ex: Huawei P15 Pro for sale">
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" name="description" class="form-control ckeditor-editor"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" id="price" name="price" class="form-control" min="1" step="1"
                                            placeholder="0.00">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="condition_new" class="form-label">Condition</label>
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="condition"
                                                    id="condition_new" value="new" checked>
                                                <label class="form-check-label" for="condition_new">New</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="condition"
                                                    id="condition_used" value="used">
                                                <label class="form-check-label" for="condition_used">Used</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="condition"
                                                    id="condition_parts_only" value="parts-only">
                                                <label class="form-check-label" for="condition_parts_only">Parts
                                                    Only</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="mb-3">
                                        <label for="is_price_negotiable" class="form-label">Is Price Negotiable</label>
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="is_price_negotiable"
                                                    id="is_price_negotiable_yes" value="1" checked>
                                                <label class="form-check-label" for="is_price_negotiable_yes">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="is_price_negotiable"
                                                    id="is_price_negotiable_no" value="0">
                                                <label class="form-check-label" for="is_price_negotiable_no">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="mb-3">
                                        <label for="is_offers_accepted" class="form-label">Is Offers Accepted</label>
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="is_offers_accepted"
                                                    id="is_offers_accepted_yes" value="1" checked>
                                                <label class="form-check-label" for="is_offers_accepted_yes">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="is_offers_accepted"
                                                    id="is_offers_accepted_no" value="0">
                                                <label class="form-check-label" for="is_offers_accepted_no">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="mb-3">
                                        <label for="min_offer" class="form-label">Minimum Offer</label>
                                        <input type="number" id="min_offer" name="min_offer" class="form-control" min="1" step="1"
                                            placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 mt-3 pt-3 border-top">
                                <button type="submit" class="btn btn-success">Create Advertisement</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
