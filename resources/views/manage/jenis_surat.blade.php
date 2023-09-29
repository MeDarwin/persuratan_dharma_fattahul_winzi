@extends('layout.layout')
@section('title', 'Manage Jenis Surat')
@section('main')
    <div class="card">
        <div class="card-header"><a href="{{ url('surat', ['jenis', 'add']) }}" class="btn btn-success">Tambah Jenis Surat</a>
        </div>
        <div class="card-body">
            <div class="row">

                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Jenis Surat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_js as $js)
                            <tr idJS="{{ $js->id }}">
                                <td>{{ $js->jenis_surat }}</td>
                                <td class="col-1">
                                    <div class="row mx-2">
                                        <button class="btnDelete col btn btn-danger">Delete</button>
                                    </div>
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
            let idJS = $(this).closest('tr').attr('idJS');
            window.location.href = `/surat/jenis/${idJS}/edit`
        })
        $('.table').on('click', '.btnDelete', function() {
            let idJS = $(this).closest('tr').attr('idJS')
            axios.delete(`/surat/jenis/${idJS}/delete`)
                .then(() => window.location.reload())
                .catch(() => window.location.reload())
        })
    </script>
@endsection
