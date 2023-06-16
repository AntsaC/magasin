@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <div class="pagetitle">
            <h1>
                User lists
            </h1>
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-success">
            + New user
        </a>
    </div>
    <div class="card mt-4">
        <div class="card-body mt-3">
            <table id='data' class="table table-hover">
                <thead>
                    <tr>

            <th>Id</th>

            <th>Name</th>

            <th>Email</th>

            <th>Affected point</th>

                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                            <tr>

            <td>{{ $user->id }}</td>

            <td>{{ $user->name }}</td>

            <td>{{ $user->email }}</td>

            <td>{{ $user->sale_point->location ?? '' }}</td>

                                <td class="text-center">
                                    <a href="{{ route('users.edit', $user->id) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <span>
                    <form class="d-inline" method="POST" action="{{ route("users.destroy", $user->id) }}">
                    @csrf
                        @method("DELETE")
                    <button style="background: none" class="border-0" >
                        <span><i class="fas fa-trash text-danger"></i></span>
                    </button>
                </form>
                </span>
                                </td>

                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

        @section('js')
        <script>
        $(document).ready(function() {
            $('#data').DataTable({
                dom: 'Bfrtip',
                buttons: []
            });
        })
        </script>
        @endsection

