@extends("layout.layout")
@section("title", "Add Jenis Surat")
@section("main")
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="display-4 mb-4">Tambah Jenis Surat</div>
                    <form method="POST" action="{{ url("surat", ["jenis", "add"]) }}">
                        @csrf
                        <input placeholder="Jenis Surat" type="text" name="jenis_surat" class="form-control mb-3">
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
