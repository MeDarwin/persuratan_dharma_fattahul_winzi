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
                            <th>Jenis Surat</th>
                            <th>Dibuat Oleh</th>
                            <th>Tanggal pembuatan</th>
                            <th>File surat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($surats as $surat)
                            <tr idSurat="{{ $surat->id }}">
                                <td>{{ $surat->ringkasan }}</td>
                                <td>{{ $surat->jenis->jenis_surat }}</td>
                                <td>{{ $surat->user->username }}</td>
                                <td>{{ $surat->tanggal_surat }}</td>
                                <td class="col-1">
                                    <div class="row mx-2 align-items-center">
                                        @if ($surat->file)
                                            <a href="{{ url("surat?path=$surat->file", ["download"]) }}"
                                                class="btn btn-primary">Download</a>
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
    </script>
@endsection
