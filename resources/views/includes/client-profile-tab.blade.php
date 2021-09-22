<div class="row">
    <div class="col-lg-12">
        <h2>Profile</h2>
        <div class="card">
            <div class="card-body">
                @if ($user->profile->isIncomplete())
                    <div class="alert alert-warning mb-3">
                        Your profile seems incomplete at the moment. Please fill the required
                        information in your profile.
                    </div>
                @endif

                <div class="alert alert-info clearfix mb-5">
                    <h3 class="float-start">Hey, Do you have something to sell?</h3>
                    <a href="#" class="btn btn-outline-primary float-end">Post an Ad</a>
                </div>

                <p>Fields with <span class="text-danger">*</span> are required.</p>

                <form action="{{ route('client.profile.update') }}" class="mt-3"
                    method="post">
                    @csrf

                    <div class="row">
                        <div class="col-lg-6 mb-2">
                            <label for="firstname" class="form-label">First Name <span
                                    class="required-label">*</span></label>
                            <input type="text" class="form-control" id="firstname"
                                name="firstname" placeholder="Enter your firstname" required
                                value="{{ $user->firstname }}">
                        </div>
                        <div class="col-lg-6 mb-2">
                            <label for="lastname" class="form-label">Last Name <span
                                    class="required-label">*</span></label>
                            <input type="text" class="form-control" id="lastname"
                                name="lastname" placeholder="Enter your lastname" required
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
                            name="address_line_1" placeholder="Enter your address line 1"
                            required value="{{ $user->profile->address_line_1 }}">
                    </div>

                    <div class="mb-2">
                        <label for="address_line_2" class="form-label">Address Line
                            2</label>
                        <input type="text" class="form-control" id="address_line_2"
                            name="address_line_2"
                            placeholder="Enter your address line 2 (optional)"
                            value="{{ $user->profile->address_line_2 }}">
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label for="city_id" class="form-label">City <span
                                        class="required-label">*</span></label>
                                <select class="form-control" id="city_id" name="city_id"
                                    required>
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
                                    name="telephone" placeholder="Enter your telephone number"
                                    required value="{{ $user->profile->telephone }}">
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
</div>