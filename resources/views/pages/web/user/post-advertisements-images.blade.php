@extends('layouts.web.master')

@section('custom-js')
    <script>
        function previewFile(fileInput, image) {
            const file = fileInput.files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function() {
                // convert image file to base64 string
                image.src = reader.result;
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        let fileInputs = document.getElementsByClassName('ad_images');
        for (var i = 0; i < fileInputs.length; i++) {
            let fileInput = fileInputs[i];

            fileInput.addEventListener('change', function(e) {
                let image = document.getElementById(e.target.id + '_thumbnail');
                previewFile(e.target, image);
            }, false);
        }
    </script>
@endsection

@section('custom-css')
@endsection

@section('contents')

    <div class="container p-5">
        <div class="col-lg-12">
            <a href="{{ route('client.profile') }}" class="btn btn-outline-primary float-end">Go back to profile</a>
        </div>
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-text">
                        Add Images for <span class="text-success">{{ $advertisement->title }}</span>
                    </h4>

                    <form action="{{ route('client.advertisement.create-images', $advertisement->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="mb-3 mt-3">
                                    <label for="image_1" class="form-label">Image 1</label>
                                    <input class="form-control ad_images" type="file" id="image_1" name="image_1" 
                                    accept="image/jpeg,image/png" required>
                                </div>
                                <div class="thumbnail" id="thumbnail_image_1">
                                    <img id="image_1_thumbnail"
                                        src="https://via.placeholder.com/280/5274d9/FFFFFF?text=PLEASE+SELECT+IMAGE"
                                        alt="Image 1" width="100%" height="280">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3 mt-3">
                                    <label for="image_2" class="form-label">Image 2</label>
                                    <input class="form-control ad_images" type="file" id="image_2" name="image_2" accept="image/jpeg,image/png">
                                </div>
                                <div class="thumbnail" id="thumbnail_image_2">
                                    <img id="image_2_thumbnail"
                                        src="https://via.placeholder.com/280/5274d9/FFFFFF?text=PLEASE+SELECT+IMAGE"
                                        alt="Image 2" width="100%" height="280">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3 mt-3">
                                    <label for="image_3" class="form-label">Image 3</label>
                                    <input class="form-control ad_images" type="file" id="image_3" name="image_3" accept="image/jpeg,image/png">
                                </div>
                                <div class="thumbnail" id="thumbnail_image_3">
                                    <img id="image_3_thumbnail"
                                        src="https://via.placeholder.com/280/5274d9/FFFFFF?text=PLEASE+SELECT+IMAGE"
                                        alt="Image 3" width="100%" height="280">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3 mt-3">
                                    <label for="image_4" class="form-label">Image 4</label>
                                    <input class="form-control ad_images" type="file" id="image_4" name="image_4" accept="image/jpeg,image/png">
                                </div>
                                <div class="thumbnail" id="thumbnail_image_4">
                                    <img id="image_4_thumbnail"
                                        src="https://via.placeholder.com/280/5274d9/FFFFFF?text=PLEASE+SELECT+IMAGE"
                                        alt="Image 4" width="100%" height="280">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 mt-3">
                                <button type="submit" class="btn btn-primary">Upload Images</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
