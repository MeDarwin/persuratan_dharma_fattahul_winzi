@extends("layout.layout")
@section("title", "Add Jenis Surat")
@section("main")
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="display-4 mb-4">Tambah Jenis Surat</div>
                    <form enctype="multipart/form-data" method="POST" action="{{ url("surat", ["add"]) }}" class="row row-gap-3 px-2">
                        @csrf
                        <div class="col p-0">
                            <div class="row justify-content-between">
                                <div class="col order-2">
                                    <label for="jenisSurat">Tanggal Surat</label>
                                    <select title="Jenis surat" id="jenisSurat" name="id_jenis_surat" class="form-select">
                                        <option selected value="">Pilih jenis surat</option>
                                        @foreach ($all_js as $js)
                                            <option value="{{ $js->id }}"">{{ $js->jenis_surat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-auto order-1">
                                    <label for="tglSurat">Tanggal Surat</label>
                                    <input type="datetime-local" name="tanggal_surat" id="tglSurat" class="form-control">
                                </div>
                            </div>
                        </div>
                        <textarea name="ringkasan" id="" class="form-control" rows="7" placeholder="Ringkasan" style="resize: none"></textarea>
                        <div class="col">
                            <div class="row align-items-center">
                                <label for="fileUpload" class="btn w-auto btn-outline-success form-control">Upload File</label>
                                <input type="file" accept=".pdf" name="file" id="fileUpload" class="d-none">
                            </div>
                        </div>
                        @auth
                            <input type="hidden" name="id_user" class="d-none" value="{{ Auth::user()["id"] }}">
                        @endauth
                        <button type="submit" class="btn btn-success">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("footer")
    <script type="module">
        $('input[type=file]').on('input', function(e) {
            $('#fileName').detach()
            $(this).after(function() {
                return "<div class='col' id='fileName'>Uploaded file : " + $(this).prop('files')[0].name + "</div>"
            })
        })
    </script>
@endsection
