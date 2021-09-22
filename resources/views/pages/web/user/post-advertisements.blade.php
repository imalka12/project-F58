@extends('layouts.web.master')

@section('custom-js')
    <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
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
                    <form action="#" method="post">
                        @csrf

                        {{-- 'type',
        'sub_category_id',
        'city_id',
        'title',
        'description',
        'condition',
        'price',
        'is_price_negotiable',
        'is_offers_accepted',
        'min_offer',
        'expire_at',
        'renewed_at',
        'is_approved',
        'approved_by_user_id',
        'is_promoted', --}}

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
            <div class="ckeditor-editor"></div>
          </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection