@extends("layout.layout")
@section("title", "Add User")
@section("main")
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="display-4 mb-4">Tambah User</div>
                    <form method="POST" action="{{ url("user", ["add"]) }}">
                        @csrf
                        <input placeholder="Username" type="text" name="username" class="form-control mb-3">
                        <input placeholder="Password" type="text" name="password" class="form-control mb-3">
                        <select name="role" class="form-select mb-3">
                            <option selected value="operator">Operator</option>
                            <option value="admin">Admin</option>
                        </select>
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
