@extends("layout.layout")
@section("title", "Dashboard")
@section("main")
    <div class="row row-gap-4 mb-5">

        <div class="row row-gap-4">
            <div class="col col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <canvas id="cvs1"></canvas>
                    </div>
                </div>
            </div>
            @auth
                @if (Auth::user()->role === "admin")
                    <div class="col col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <canvas id="cvs2"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <canvas id="cvs3"></canvas>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header h1">Transaksi surat terbaru</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Ringkasan</th>
                                    <th class="col-1">Download</th>
                                    <th class="col-2">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($surat_terbaru as $surat)
                                    <tr>
                                        <td>{{ $surat->ringkasan }}</td>
                                        <td>
                                            <div class="row mx-2 align-items-center">
                                                @if ($surat->file)
                                                    <a href="{{ url("surat?path=$surat->file", ["download"]) }}" class="btn btn-primary">Download</a>
                                                @else
                                                    <p class="text-center m-0 p-0">No File</p>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $surat->tanggal_surat }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section("footer")
    <script type="module">
        const ctx1 = $('#cvs1')
        const ctx2 = $('#cvs2')
        const ctx3 = $('#cvs3')

        //Surat diagram
        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($tahun_diagram); ?>,
                datasets: [{
                    label: 'Statistika surat 5 tahun ke belakang',
                    data: <?php echo json_encode($surat_diagram_data); ?>,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        },
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: (context) => `Surat terkirim pada ${context.label} : ${context.formattedValue}`,
                        }
                    }
                },
            }
        })
        //User diagram
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($user_diagram); ?>,
                datasets: [{
                    label: 'User paling aktif',
                    data: <?php echo json_encode($user_diagram_data); ?>,
                }]
            },

            options: {
                scales: {
                    y: {
                        ticks: {
                            stepSize: 1
                        },
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: (context) => `${context.formattedValue} Surat dibuat oleh ${context.label}`,
                        }
                    }
                },
            }
        })
        // Jenis surat diagram
        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($jenis_diagram); ?>,
                datasets: [{
                    label: 'Jenis surat paling banyak digunakan',
                    data: <?php echo json_encode($jenis_diagram_data); ?>
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        },
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: (context) => `Surat terkirim pada ${context.label} : ${context.formattedValue}`,
                        }
                    }
                },
            }
        })
    </script>
@endsection
