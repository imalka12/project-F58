@extends('layouts.web.master')

@section('contents')
    <div class="container p-5">
        @if ($user->status === 'inactive')
            <div class="alert alert-warning">
                Your account is inactive. Did you verify your email address yet?
            </div>
        @else
            <div class="row">
                <div class="col-lg-4">
                    <h2>Hello {{ auth()->user()->firstname }}!</h2>
                    <aside class="mt-5">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item mb-3">
                                <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile" href="#">My
                                    Profile</a>
                            </li>
                            <li class="nav-item mb-3">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ads" href="#">My
                                    Advertisements</a>
                            </li>
                            <li class="nav-item mb-3">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#payments" href="#">My
                                    Payments</a>
                            </li>
                            <li class="nav-item mb-3">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#settings"
                                    href="#">Settings</a>
                            </li>
                        </ul>
                    </aside>
                </div>
                <div class="col-lg-8">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="profile" role="tabpanel">
                            <h2>Profile</h2>
                            <div class="card">
                                <div class="card-body">
                                    @if ($user->profile->isIncomplete())
                                        <div class="alert alert-warning mb-3">
                                            Your profile seems incomplete at the moment. Please fill the required
                                            information in your profile.
                                        </div>
                                    @endif
                                    <p>Fields with <span class="text-danger">*</span> are required.</p>

                                    <form action="{{ route('client.profile.update') }}" class="mt-3"
                                        method="post">
                                        @csrf

                                        <div class="row">
                                            <div class="col-lg-6 mb-2">
                                                <label for="firstname" class="form-label">First Name <span
                                                        class="required-label">*</span></label>
                                                <input type="text" class="form-control" id="firstname" name="firstname"
                                                    placeholder="Enter your firstname" required
                                                    value="{{ $user->firstname }}">
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <label for="lastname" class="form-label">Last Name <span
                                                        class="required-label">*</span></label>
                                                <input type="text" class="form-control" id="lastname" name="lastname"
                                                    placeholder="Enter your lastname" required
                                                    value="{{ $user->lastname }}">
                                            </div>
                                        </div>

                                        <div class="mb-2">
                                            <label for="email" class="form-label">Email Address</label>
                                            <p class="form-control">{{ $user->email }}</p>
                                        </div>

                                        <div class="mb-2">
                                            <label for="address_line_1" class="form-label">Address Line 1 <span
                                                    class="required-label">*</span></label>
                                            <input type="text" class="form-control" id="address_line_1"
                                                name="address_line_1" placeholder="Enter your address line 1" required
                                                value="{{ $user->profile->address_line_1 }}">
                                        </div>

                                        <div class="mb-2">
                                            <label for="address_line_2" class="form-label">Address Line 2</label>
                                            <input type="text" class="form-control" id="address_line_2"
                                                name="address_line_2" placeholder="Enter your address line 2 (optional)"
                                                value="{{ $user->profile->address_line_2 }}">
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-2">
                                                    <label for="city_id" class="form-label">City <span
                                                            class="required-label">*</span></label>
                                                    <select class="form-control" id="city_id" name="city_id" required>
                                                        <option value="">Select your city</option>
                                                        @foreach ($cities as $district => $districtCities)
                                                            <optgroup label="{{ $district }}">
                                                                @foreach ($districtCities as $city)
                                                                    <option value="{{ $city->id }}"
                                                                        {{ $user->profile->city_id == $city->id ? 'selected' : '' }}>
                                                                        {{ $city->title }}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-2">
                                                    <label for="telephone" class="form-label">Telephone <span
                                                            class="required-label">*</span></label>
                                                    <input type="text" class="form-control" id="telephone"
                                                        name="telephone" placeholder="Enter your telephone number" required
                                                        value="{{ $user->profile->telephone }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-success">Update Profile</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="ads" role="tabpanel">
                            <h2>Advertisements</h2>
                        </div>
                        <div class="tab-pane fade" id="payments" role="tabpanel">
                            <h2>Payments</h2>
                        </div>
                        <div class="tab-pane fade" id="settings" role="tabpanel">
                            <h2>Settings</h2>
                        </div>
                    </div>






                </div>
            </div>
        @endif
    </div>

@endsection
