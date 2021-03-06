@extends('layouts.master')

@section('title') Sub Categories @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Home @endslot
        @slot('title') Category Options @endslot
        @slot('title') Sub Categories @endslot
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <form action="{{ route('admin.subcategory.create') }}" method="post" class="mt-3">
                        <div class="card-body">
                            <h4 class="card-text mb-3">Create New Sub Category</h4>

                            @csrf

                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"> {{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label">Title </label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Ex: Farming Tools & Machinery">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success" id="create_subcategories">Create</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover" id="categories-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Title</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subCategories as $subCategory)
                                    <tr>
                                        <td> {{ $loop->iteration }}</td>
                                        <td> {{ $subCategory->category->title }} </td>
                                        <td> {{ $subCategory->title }}</td>
                                        <td>
                                            <a href="{{ route('admin.subcategory.edit' , $subCategory->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('admin.subcategory.delete' , $subCategory->id ) }}" class="d-inline" method="post" onsubmit="return confirm('Are you sure you need to delete this subCategory?\n\nPlease note that all the associated values too will be deleted.\nPlease proceed with caution.');">
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
    $('#categories-table').DataTable();
</script>
@endsection
