@extends('base')

@section('title','Clients')

@section('bodyTitle','Clients')

@section('body')
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Clients</h3>
            <div class="card-tools">
                <a href="{{ route('clients.create') }}" class="btn btn-primary">Add Client</a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($clients as $client)
                    <tr class="align-middle">
                        <td>{{ $client->code }}</td>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>{{ $client->address }}</td>
                        <td>{{ $client->type }}</td>
                        <td>
                            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
