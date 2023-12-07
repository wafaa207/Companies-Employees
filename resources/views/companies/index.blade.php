@extends('include.pages-layout')
@section('pageTitle' , isset($pageTitle) ? $pageTitle : 'Companies')
@section('content')

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Companies
                    </h2>
                </div>
            </div>
        </div>
    </div>


    <div class="col-6 col-sm-4 col-md-2 col-xl py-3">
        <a href="{{ route('companies.create') }}" class="btn btn-success btn-pill w-100">
            add new company
        </a>
    </div>

    @if($companies->isEmpty())
        <div class="row g-2 align-items-center">
            <div class="col">
                <h4 class="page-title">
                    There are No Companies Yet.
                </h4>
            </div>
        </div>
    @else
        <div class="col-12">
        <div class="card">
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Logo</th>
                        <th>Control</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($companies as $company)
                            <tr>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->email }}</td>
                                <td><img src="{{ asset($company->logo) }}" alt="{{ $company->name }} Logo" style="max-width: 100px;"></td>
                                <td>
                                    <div class="d-flex">
                                        <div class="col-md-3 col-sm-6">
                                            <a href="{{ route('companies.edit', ['company' => $company->id]) }}" class="btn btn-cyan">
                                                Edit
                                            </a>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <form action="{{ route('companies.destroy', ['company' => $company->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-red" onclick="return confirm('Are you sure you want to delete this company?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    <br>
    <div class="d-block mt-2 text-center">
        {{ $companies->links() }}
    </div>


@endsection
