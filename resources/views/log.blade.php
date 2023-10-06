@extends("layout.layout")
@section("title", "Log activities")
@section("main")
    <div class="card-body">
        <div class="row">

            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>Activity</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $log)
                        @php
                            $type = "";
                            switch ($log->action) {
                                case "UPDATE":
                                    $type = "success";
                                    break;
                                case "INSERT":
                                    $type = "primary";
                                    break;
                                case "DELETE":
                                    $type = "danger";
                                    break;
                            }
                        @endphp
                        <tr>
                            <td>
                                <div @class(["badge", "text-bg-$type"])>{{ $log->action }}</div>
                            </td>
                            <td>{{ $log->activity }}</td>
                            <td>{{ $log->activity_time }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
