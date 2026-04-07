@extends('layout')

@section('content')
    <h1>
        Customers List
        <a href="{{ route('customers.trashed') }}" class="btn btn-secondary btn-sm float-end">Go to Trash</a>
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
                        <a href="{{ route('customers.trash', $customer->id) }}" class="btn btn-sm btn-danger">Trash</a>
                        {{-- <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form> --}}
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