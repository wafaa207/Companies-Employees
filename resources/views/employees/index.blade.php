@extends('include.pages-layout')
@section('pageTitle' , isset($pageTitle) ? $pageTitle : 'Employees')
@section('content')

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Employees
                    </h2>
                </div>
            </div>
        </div>
    </div>


    <div class="col-6 col-sm-4 col-md-2 col-xl py-3">
        <a href="{{ route('employees.create') }}" class="btn btn-success btn-pill w-100">
            add new employee
        </a>
    </div>
    @if($employees->isEmpty())
        <div class="row g-2 align-items-center">
            <div class="col">
                <h4 class="page-title">
                    There are No Employees Yet.
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
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Company</th>
                        <th>Control</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <td>{{ $employee->first_name }}</td>
                                <td>{{ $employee->last_name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->phone }}</td>
                                <td>{{ $employee->company->name }}</td>
                                <td>
                                    <div class="d-flex">
                                        <div class="col-md-6 col-sm-6">
                                            <form action="{{ route('employees.edit', ['employee' => $employee->id]) }}" method="post">
                                                @csrf
                                                @method('GET')
                                                <button type="submit" class="btn btn-cyan">
                                                    Edit
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <form action="{{ route('employees.destroy', ['employee' => $employee->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-red">
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
        {{ $employees->links() }}
    </div>


@endsection
