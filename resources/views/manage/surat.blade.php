@extends("layout.layout")
@section("title", "Manage Surat")
@section("main")
    <div class="card">
        <div class="card-header">
            <a href="{{ url("surat", ["send"]) }}" class="btn btn-success">Kirim Surat</a>
        </div>
        <div class="card-body">
            <div class="row">

                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Ringkasan</th>
                            <th>Dibuat Oleh</th>
                            <th>Tanggal pembuatan</th>
                            <th>Edit file</th>
                            <th>File surat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($surats as $surat)
                            <tr idSurat="{{ $surat->id }}">
                                <td>{{ $surat->ringkasan }}</td>
                                <td>{{ $surat->user->username }}</td>
                                <td>{{ $surat->tanggal_surat }}</td>
                                <td class="col-3">
                                    <div class="row">
                                        <form method="POST" enctype="multipart/form-data" action="{{ url("surat", [$surat->id, "file"]) }}"
                                            id="file_{{ $surat->id }}">
                                            @csrf
                                            <input type="file" accept=".pdf" name="file" class="form-control">
                                        </form>
                                    </div>
                                    <div class="row mt-2">
                                        <button class="col mx-2 btn btn-primary" type="submit" form="file_{{ $surat->id }}">Confirm</button>
                                        @isset($surat->file)
                                            <button class="col-auto mx-2 btn btn-danger btnDeleteFile">Delete File</button>
                                        @endisset
                                    </div>
                                </td>
                                <td class="col-1">
                                    <div class="row mx-2">
                                        @if ($surat->file)
                                            <a href="{{ url("surat?path=$surat->file", ["download"]) }}" class="btn btn-primary">Download</a>
                                        @else
                                            <p class="text-center m-0 p-0">No File</p>
                                        @endif
                                    </div>
                                </td>
                                <td class="col-1">
                                    <div class="row mx-2"><a class="btnDelete col btn btn-danger">Delete</a></div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
@section("footer")
    <script type="module">
        $('.table').DataTable()
        $('.table').on('click', '.btnDelete', function() {
            let idSurat = $(this).closest('tr').attr('idSurat')
            axios.delete(`/surat/${idSurat}/delete`)
                .then(() => window.location.reload())
                .catch(() => window.location.reload())
        })
        $('.table').on('click', '.btnDeleteFile', function() {
            let idSurat = $(this).closest('tr').attr('idSurat')
            axios.delete(`/surat/${idSurat}/file`)
                .then(() => window.location.reload())
                .catch(() => window.location.reload())
        })
        $('.table').on('click', 'tbody > tr > td:first-child', function() {
            let idS = $(this).closest('tr').attr('idSurat');
            window.location.href = `/surat/${idS}/edit`
        })
    </script>
@endsection
