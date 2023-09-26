@extends("layout.layout")
@section("title", "Edit User $user->username")
@section("main")
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="display-4 mb-4">Edit User {{ $user->username }}</div>
                    <form method="POST" action="{{ url("user", [$user->id, "edit"]) }}">
                        @csrf
                        <input placeholder="Username" type="text" name="username" class="form-control mb-3" value="{{ $user->username }}">
                        <input placeholder="New password" type="text" name="password" class="form-control mb-3">
                        <select name="role" class="form-select mb-3" title="user role">
                            <option @if ($user->role === "operator") selected @endif value="operator">Operator</option>
                            <option @if ($user->role === "admin") selected @endif value="admin">Admin</option>
                        </select>
                        <button type="submit" class="btn btn-success">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
