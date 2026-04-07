@extends('layout')

@section('content')
    <h1>
        Customers Trashed List
        <a href="{{ url('/customers') }}" class="btn btn-secondary btn-sm float-end">Go to Customers List</a>
    </h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table id="customersTable" class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $key => $customer)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $customer->user_name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>
                        <a href="{{ route('customers.delete', $customer->id) }}" class="btn btn-sm btn-danger">Delete</a>
                        <a href="{{ route('customers.restore', $customer->id) }}" class="btn btn-sm btn-success">Restore</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#customersTable').DataTable();
        });
    </script>
@endsection