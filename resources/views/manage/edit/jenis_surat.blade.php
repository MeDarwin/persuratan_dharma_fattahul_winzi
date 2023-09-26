@extends("layout.layout")
@section("title", "Edit Jenis Surat")
@section("main")
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="display-4 mb-4">Edit Jenis Surat {{ $js->jenis_surat }}</div>
                    <form method="POST" action="{{ url("surat", ["jenis", $js->id, "edit"]) }}">
                        @csrf
                        <input placeholder="Jenis Surat" type="text" name="jenis_surat" class="form-control mb-3" value="{{ $js->jenis_surat }}">
                        <button type="submit" class="btn btn-success">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
