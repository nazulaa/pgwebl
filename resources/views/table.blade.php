@extends('layout/template')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.min.js"></script>
    <script>
        let tablepoints = new DataTable('#pointstable');
        let tablepolyline = new DataTable('#polylinetable');
        let tablepolygon = new DataTable('#polygontable');
    </script>
@endsection

@section('content')
    <div class="container mt-4 mb-4 ">
        <div class="card">
            <div class="card-header">
                <h4>Data Points</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="pointstable">
                    <thead class="bg-danger text-white">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($points as $p)
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->description }}</td>
                                <td>
                                    <img src="{{ asset('storage/images/' . $p->image) }}" alt="" width="200"
                                        title="{{ $p->image }}">
                                </td>
                                <td>{{ $p->created_at }}</td>
                                <td>{{ $p->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="container mt-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4>Data Polylines</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="polylinetable">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($polyline as $p)
                                <tr>
                                    <td>{{ $p->id }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->description }}</td>
                                    <td>
                                        <img src="{{ asset('storage/images/' . $p->image) }}" alt="" width="200"
                                            title="{{ $p->image }}">
                                    </td>
                                    <td>{{ $p->created_at }}</td>
                                    <td>{{ $p->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

    <div class="container mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Polygons</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="polygontable">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($polygon as $p)
                                        <tr>
                                            <td>{{ $p->id }}</td>
                                            <td>{{ $p->name }}</td>
                                            <td>{{ $p->description }}</td>
                                            <td>
                                                <img src="{{ asset('storage/images/' . $p->image) }}" alt=""
                                                    width="200" title="{{ $p->image }}">
                                            </td>
                                            <td>{{ $p->created_at }}</td>
                                            <td>{{ $p->updated_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endsection
