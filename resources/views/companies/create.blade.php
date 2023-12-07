@extends('include.pages-layout')
@section('pageTitle' , isset($pageTitle) ? $pageTitle : 'Create Company')
@section('content')

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Create Company
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('companies.store') }}" method="post" id="addPostForm" enctype="multipart/form-data">
        @csrf
        <div class="card mt-5" style="max-width: 500px;">
            <div class="card-body">
                <div class="col-md-12 ">
                    <div class="mb-3">
                        <label class="form-label">Company Name</label>
                        <input class="form-control" type="text" name="company_name" placeholder="Company Name....">
                        <span class="text-danger">@error('company_name'){{ $message }}@enderror</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Company Email</label>
                        <input class="form-control" type="email" name="company_email" placeholder="Company Email....">
                        <span class="text-danger">@error('company_email'){{ $message }}@enderror</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Company Image</label>
                        <input class="form-control" type="file" name="company_image" accept="image/*" multiple>
                        <span class="text-danger">@error('company_image'){{ $message }}@enderror</span>
                    </div>
                    <div class="image-holder mb-2" style="max-width: 100px; display: flex;">
                        <!-- Add a default image or message when no images are selected -->
                        <p id="no-images-message" style="display: none;">No images selected</p>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </div>
        </div>
    </form>


@endsection

@push('scripts')

    {{-- Debugging --}}
    @if($errors->any())
        @foreach($errors->all() as $error)
            <script>
                iziToast.error({
                    title: '',
                    position:'topRight',
                    message: '{{ $error }}'
                });
            </script>
        @endforeach
    @endif

    @if(session()->has('error'))
        <script>
            iziToast.error({
                title: '',
                position:'topRight',
                message: '{{ session('error') }}'
            });
        </script>
    @endif


    <script>
        document.querySelector('input[type="file"]').addEventListener('change', function () {
            const imageHolder = document.querySelector('.image-holder');
            const noImagesMessage = document.getElementById('no-images-message');
            imageHolder.innerHTML = ''; // Clear previous images

            // Display the message when no images are selected
            if (this.files.length === 0) {
                noImagesMessage.style.display = 'block';
                return;
            } else {
                noImagesMessage.style.display = 'none';
            }

            for (const file of this.files) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = 'Image Preview';
                    img.classList.add('img-thumbnail');

                    imageHolder.appendChild(img);
                };

                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush

