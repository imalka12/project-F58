@extends('layouts.master')

@section('title') Edit sub category @endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Home @endslot
        @slot('title') Category Options @endslot
        @slot('title') Edit Sub Categories @endslot
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <a href="{{ route('admin.subcategory.add') }}" class="btn btn-info">Back to view all sub categories</a>
            </div>
            <div class="col-lg-4">
                <div class="card mt-4">
                    <div class="card-header">
                        Edit sub categories
                    </div>
                    <form action="{{ route('admin.subcategory.update', $subCategory->id) }}" method="post" id="categories-table">
                        <div class="card-body">
                            <h4 class="card-text mb-3">Edit {{ $subCategory->title }}</h4>

                            @csrf

                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                   @foreach ($categories as $categoryId => $category)
                                       <option value="{{ $categoryId }}" 
                                       {{ $subCategory->category_id == $categoryId ? 'selected' : '' }}
                                       >{{ $category['title'] }}</option>
                                   @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Ex: Car"
                                    value="{{ $subCategory->title }}">
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-warning" id="update_subcategory">Update</button>
                        </div>
                    </form>
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
