@extends('layouts.master')

@section('title') Category Options @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Home @endslot
        @slot('title') Category Options @endslot
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <form action="{{ route('admin.option-groups.create') }}" class="mt-3" method="post">
                        <div class="card-body">
                            <h4 class="card-text mb-3">Create New Category Option</h4>

                            @csrf

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

                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Ex: Brand Name">
                            </div>

                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" placeholder="Ex: brand-name">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success" id="create_category_option">Create</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover" id="option-groups-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Sub Category</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($optionGroups as $optionGroup)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $optionGroup->subCategory->title }}</td>
                                    <td>{{ $optionGroup->title }}</td>
                                    <td>{{ $optionGroup->slug }}</td>
                                    <td>
                                        <a href="{{ route('admin.option-groups.edit', $optionGroup->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('admin.option-groups.delete', $optionGroup->id) }}" class="d-inline" method="post" onsubmit="return confirm('Are you sure you need to delete this option group?\n\nPlease note that all the associated values too will be deleted.\nPlease proceed with caution.');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
    $('#option-groups-table').DataTable();
</script>
@endsection
