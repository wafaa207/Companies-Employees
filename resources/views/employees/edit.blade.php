@extends('include.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Edit Employee')
@section('content')

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Edit Employee
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('employees.update', ['employee' => $employee->id]) }}" method="post" id="editEmployeeForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card mt-5" style="max-width: 500px;">
            <div class="card-body">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Employee First Name</label>
                        <input class="form-control" type="text" name="first_name" placeholder="Employee First Name...." value="{{ $employee->first_name }}" required>
                        <span class="text-danger">@error('first_name'){{ $message }}@enderror</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Employee Last Name</label>
                        <input class="form-control" type="text" name="last_name" placeholder="Employee Last Name...." value="{{ $employee->last_name }}" required>
                        <span class="text-danger">@error('last_name'){{ $message }}@enderror</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Employee Email</label>
                        <input class="form-control" type="email" name="email" placeholder="Employee Email...." value="{{ $employee->email }}" required>
                        <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Employee Phone</label>
                        <input class="form-control" type="number" name="phone" placeholder="Employee Phone...." value="{{ $employee->phone }}" required>
                        <span class="text-danger">@error('phone'){{ $message }}@enderror</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Company</label>
                        <select class="form-control" name="company_id">
                            <option value="">None</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ $company->id == $employee->company_id ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('company_id'){{ $message }}@enderror</span>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </form>

@endsection


