@extends('layouts.master')

@section('title') Block Users @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Home @endslot
        @slot('title') Block Users @endslot
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Email</th>
                                    <th>Created at</th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($user as $users)
                                    <tr>
                                        <td>{{ $users->id }}</td>
                                        <td>{{ $users->email }}</td>
                                        <td>{{ $users->email_verified_at }}</td>
                                        <td>
                                            <form action="" class="d-inline" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success">View</button>
                                            </form>

                                            <form action="{{ route('admin.user-block', $users->id) }}" class="d-inline" method="post"
                                                onsubmit="return confirm('Are you sure you want to block this user?');">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger">Block</button>
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

@section('script')
@endsection
