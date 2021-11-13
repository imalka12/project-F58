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
            @if(count($advertisement->advertisementImages) > 0)
                <div class="card mb-5">
                    <div class="card-body">
                        <h4 class="card-text">
                            Remove Images for <span class="text-success">{{ $advertisement->title }}</span>
                        </h4>

                        <div class="row">
                            @foreach($advertisement->advertisementImages as $image)
                            <div class="col-lg-3">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img src="{{ asset('storage/advs-images/' . $image->image) }}" class="img-fluid" 
                                            style="height: 150px !important;" alt="">
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-lg-12">
                                                <form action="{{ route('advertisement.unpaid.images.delete', $image->id) }}" method="post" 
                                                    onsubmit="return confirm('Are you sure you need to remove this image?\nRemoving this image will free a slot to add a new image.\n\nCaution: This action is irreversible.')">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger w-100">Remove</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <h4 class="card-text">
                        Add new Images for <span class="text-success">{{ $advertisement->title }}</span>
                    </h4>

                    <form action="{{ route('advertisement.unpaid.images.update', $advertisement->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @php
                            $imagesCount = $advertisement->advertisementImages->count();
                            $imageNumber = $advertisement->advertisementImages->count() + 1;
                        @endphp
                        <div class="row">
                            @for ($i = $imagesCount; $i < 4; $i++)
                                <div class="col-lg-3">
                                    <div class="mb-3 mt-3">
                                        <label for="image_{{ $imageNumber }}" class="form-label">
                                            Image {{ $imageNumber }}
                                        </label>
                                        <input class="form-control ad_images" type="file" 
                                        id="image_{{ $imageNumber }}" name="image_{{ $imageNumber }}" 
                                        accept="image/jpeg,image/png"
                                        @if($imagesCount == 0 && $imageNumber == 1)
                                            required
                                        @endif
                                        >
                                    </div>
                                    <div class="thumbnail" id="thumbnail_image_{{ $imageNumber }}">
                                        <img id="image_{{ $imageNumber }}_thumbnail"
                                            src="https://via.placeholder.com/280/5274d9/FFFFFF?text=PLEASE+SELECT+IMAGE"
                                            alt="Image {{ $imageNumber }}" width="100%" height="280">
                                    </div>
                                </div>
                                @php
                                    $imageNumber++;
                                @endphp
                            @endfor
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
