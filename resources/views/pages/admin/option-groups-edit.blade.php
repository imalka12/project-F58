@extends('layouts.master')

@section('title') Edit Category Option Group @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Category Options @endslot
        @slot('title') Edit Option Group @endslot
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <a href="{{ route('admin.option-groups.add') }}" class="btn btn-info">Back to all option groups</a>
            </div>
            <div class="col-lg-4">
                <div class="card mt-4">
                    <div class="card-header">
                        Edit Option Group
                    </div>
                    <form action="{{ route('admin.option-groups.update', $optionGroup->id) }}" method="post">
                        <div class="card-body">
                            <h4 class="card-text mb-3">Edit {{ $optionGroup->title }}</h4>

                            @csrf

                            <div class="mb-3">
                                <label for="sub_category_id" class="form-label">Category</label>
                                <select name="sub_category_id" id="sub_category_id" class="form-control">
                                    @foreach ($categories as $category)
                                        <optgroup label="{{ $category['title'] }}">
                                            @foreach ($category['subcategories'] as $subCategoryId => $subCategoryTitle)
                                                <option value="{{ $subCategoryId }}" 
                                                {{ $optionGroup->sub_category_id == $subCategoryId ? 'selected' : '' }}
                                                >{{ $subCategoryTitle }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Ex: Brand" value="{{ $optionGroup['title'] }}">
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-warning" id="update_category_option">Update</button>
                        </div>
                    </form>
                  </div>

                  <div class="card mt-4">
                    <div class="card-header">
                        Add New Option Group Value
                    </div>
                    <form action="{{ route('admin.option-group-values.create', $optionGroup->id) }}" method="post">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="value-title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="value-title" name="title" placeholder="Ex: Samsung" value="">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="create_category_value">Create</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-8">
                
            </div>
        </div>
    </div>

@endsection

@section('script')
@endsection    