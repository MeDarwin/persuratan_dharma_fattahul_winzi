@extends('layout.layout')
@section('title', 'Manage User')
@section('main')
    <div class="card">
        <div class="card-header"><a href="{{ url('user', ['add']) }}" class="btn btn-success">Tambah User</a></div>
        <div class="card-body">
            <div class="row">

                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr idUser="{{ $user->id }}">
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->role }}</td>
                                <td class="col-1">
                                    <div class="row mx-2"><button class="btnDelete col btn btn-danger">Delete</button></div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script type="module">
        $('.table').DataTable()

        $('.table').on('click', 'tbody > tr > td:first-child', function() {
            let idUser = $(this).closest('tr').attr('idUser')
            window.location.href = `/user/${idUser}/edit`
        })
        $('.table').on('click', '.btnDelete', function() {
            let idUser = $(this).closest('tr').attr('idUser')
            axios.delete(`/user/${idUser}/delete`)
                .then(() => window.location.reload())
                .catch(() => window.location.reload())
        })
    </script>
@endsection
