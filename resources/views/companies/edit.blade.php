@extends('include.pages-layout')
@section('pageTitle' , isset($pageTitle) ? $pageTitle : 'Edit Company')
@section('content')

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Edit Company
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('companies.update', ['company' => $company->id]) }}" method="post" id="editCompanyForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card mt-5" style="max-width: 500px;">
            <div class="card-body">
                <div class="col-md-12 ">
                    <div class="mb-3">
                        <label class="form-label">Company Name</label>
                        <input class="form-control" type="text" name="company_name" placeholder="Company Name...." value="{{ $company->name }}">
                        <span class="text-danger">@error('company_name'){{ $message }}@enderror</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Company Email</label>
                        <input class="form-control" type="email" name="company_email" placeholder="Company Email...." value="{{ $company->email }}">
                        <span class="text-danger">@error('company_email'){{ $message }}@enderror</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Company Image</label>
                        <input class="form-control" type="file" name="company_image" accept="image/*" multiple>
                        <span class="text-danger">@error('company_image'){{ $message }}@enderror</span>
                    </div>
                    <div class="image-holder mb-2" style="max-width: 100px; display: flex;">
                        <img src="{{ $company->logo }}" alt="Company Logo" id="previewImage" style="max-width: 100px; max-height: 100px;">
                        <p id="no-images-message" style="display: none;">No images selected</p>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
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

