@extends("layout.layout")
@section("title", "Edit Jenis Surat")
@section("main")
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="display-4 mb-1">Edit Surat</div>
                    <div class="mb-4">
                        <h6></h6>
                    </div>
                    <form method="POST" action="{{ url("surat", [$surat->id, "edit"]) }}" class="row row-gap-3 px-2">
                        @csrf
                        <div class="col p-0">
                            <div class="row justify-content-between">
                                <div class="col order-2">
                                    <label for="jenisSurat">Tanggal Surat</label>
                                    <select title="Jenis surat" id="jenisSurat" name="id_jenis_surat" class="form-select">
                                        <option selected value="">Pilih jenis surat</option>
                                        @foreach ($all_js as $js)
                                            <option @if ($surat->jenis->jenis_surat === $js->jenis_surat) selected @endif value="{{ $js->id }}"">
                                                {{ $js->jenis_surat }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-auto order-1">
                                    <label for="tglSurat">Tanggal Surat</label>
                                    <input type="datetime-local" name="tanggal_surat" id="tglSurat" class="form-control"
                                        value="{{ $surat->tanggal_surat }}">
                                </div>
                            </div>
                        </div>
                        <textarea name="ringkasan" id="" class="form-control" rows="7" placeholder="Ringkasan" style="resize: none">{{ $surat->ringkasan }}</textarea>
                        <input type="hidden" name="id_user" class="d-none" value="{{ $surat->id_user }}">
                        <button type="submit" class="btn btn-success">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
