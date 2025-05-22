@extends('layout.template')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">

    <style>
        #map {
            height: calc(100vh - 56px);
            width: 100%;
            border-radius: 20px;
        }
    </style>
@endsection

@section('content')
    <div id="map">

        <!-- Point Modal -->
        <div class="modal fade" id="createpointModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Point</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('point.store') }}" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Point Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Fill point name">
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="geom_point" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geom_point" name="geom_point" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Photo</label>
                                <input type="file" class="form-control" id="image_point" name="image"
                                    onchange="document.getElementById('preview-image-point').src = window.URL.createObjectURL(this.files[0])">
                                <img src="" alt="" id="preview-image-point" class="img-thumbnail"
                                    width="300">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Create Polyline -->
        <div class="modal fade" id="createpolylineModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Polyline</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('polylines.store') }}" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Fill Point name">
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="geom_polyline" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geom_polyline" name="geom_polyline" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Photo</label>
                                <input type="file" class="form-control" id="image_polyline" name="image"
                                    onchange="document.getElementById('preview-image-polyline').src = window.URL.createObjectURL(this.files[0])">
                                <img src="" alt="" id="preview-image-polyline" class="img-thumbnail"
                                    width="300">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Create Polygon -->
        <div class="modal fade" id="createpolygonModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Polygon</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('polygons.store') }}" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Fill Point name">
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="geom_polygon" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geom_polygon" name="geom_polygon" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Photo</label>
                                <input type="file" class="form-control" id="image_polygon" name="image"
                                    onchange="document.getElementById('preview-image-polygon').src = window.URL.createObjectURL(this.files[0])">
                                <img src="" alt="" id="preview-image-polygon" class="img-thumbnail"
                                    width="300">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <script src="https://unpkg.com/@terraformer/wkt"></script>

        <script src="https://leafletjs.com/reference.html#control-layers"></script>



        <script>
            var map = L.map('map').setView([55.66143663816052, 12.468573391153898], 12);

            var OPNVKarte = L.tileLayer('https://tileserver.memomaps.de/tilegen/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: 'Map <a href="https://memomaps.de/">memomaps.de</a> <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            });


            OPNVKarte.addTo(map);



            /* Digitize Function */
            var drawnItems = new L.FeatureGroup();
            map.addLayer(drawnItems);

            var drawControl = new L.Control.Draw({
                draw: {
                    position: 'topleft',
                    polyline: true,
                    polygon: true,
                    rectangle: false,
                    circle: false,
                    marker: true,
                    circlemarker: false
                },
                edit: false
            });

            map.addControl(drawControl);

            map.on('draw:created', function(e) {
                var type = e.layerType,
                    layer = e.layer;

                console.log(type);

                var drawnJSONObject = layer.toGeoJSON();
                var objectGeometry = Terraformer.geojsonToWKT(drawnJSONObject.geometry);

                console.log(drawnJSONObject);
                console.log(objectGeometry);

                //memunculkan modal untuk create polyline

                if (type === 'polyline') {
                    console.log("Create " + type);

                    $('#geom_polyline').val(objectGeometry);
                    //memunculkan model create polyline
                    $('#createpolylineModal').modal('show');


                    //memunculkan modal untuk create polygon
                } else if (type === 'polygon' || type === 'rectangle') {
                    console.log("Create " + type);

                    $('#geom_polygon').val(objectGeometry);
                    $('#createpolygonModal').modal('show');



                } else if (type === 'marker') {
                    console.log("Create " + type);
                    $('#geom_point').val(objectGeometry);
                    //memunculkan modal untuk create marker
                    $('#createpointModal').modal('show');
                } else {
                    console.log('__undefined__');
                }

                drawnItems.addLayer(layer);
            });

            // GeoJSON Points
            var points = L.geoJson(null, {
                pointToLayer: function(feature, latlng) {
                    var customIcon = L.divIcon({
                        className: 'custom-marker',
                        html: '<div style="background-color: #E27396; width: 20px; height: 20px; border-radius: 50%; border: 2px solid #1E1B18 ;"></div>',
                        iconSize: [20, 20],
                        iconAnchor: [10, 20]
                    });
                    return L.marker(latlng, {
                        icon: customIcon
                    });
                },
                onEachFeature: function(feature, layer) {

                    var routeDelete = "{{ route('point.destroy', ':id') }}";
                    routeDelete = routeDelete.replace(':id', feature.properties.id);

                    var routeEdit = "{{ route('point.edit', ':id') }}";
                    routeEdit = routeEdit.replace(':id', feature.properties.id);

                    var popupContent = "Nama: " + feature.properties.name + "<br>" +
                        "Deskripsi: " + feature.properties.description + "<br>" +
                        "Dibuat pada: " + feature.properties.created_at + "<br>" +
                        "<img src='{{ asset('storage/images') }}/" + feature.properties.image +
                        "' width='200' alt=''>" + "<br>" +
                        "<div class='row mt-2'>" +
                        "<div class='col-5 text-end'>" +
                        "<a href='" + routeEdit +
                        "' class='btn btn-warning btn-sm'><i class='fa-solid fa-pen-to-square'></i> Edit</a>" +
                        "</div>" +
                        "<div class='col-6'>" +
                        "<form method='POST' action='" + routeDelete + "'>" +
                        '@csrf' + '@method('DELETE')' +
                        "<button type='submit' class='btn btn-danger btn-sm text-start' onclick='return confirm(`Are you sure?`)'><i class='fa-solid fa-trash-can'></i> Hapus</button>" +
                        "</form>" +
                    "</div>" + "<br>" + "<p>Created by: " + feature.properties.user_created + "</p>";
                    "</div>";

                    //var popupContent = `Nama: ${feature.properties.name} <br>
            //Deskripsi: ${feature.properties.description} <br>
            //Dibuat : ${feature.properties.created_at} <br>
            //<img src='{{ asset('storage/images') }}/ ${feature.properties.image} width='250'
            //`;

                    layer.on({
                        click: function(e) {
                            layer.bindPopup(popupContent).openPopup();
                        },
                        mouseover: function(e) {
                            layer.bindTooltip(feature.properties.name).openTooltip();
                        },
                    });
                },
            });
            $.getJSON("{{ route('api.points') }}", function(data) {
                points.addData(data);
                map.addLayer(points);
            });


            // GeoJSON POLYLINE
            var polyline = L.geoJson(null, {
                style: function(feature) {
                    return {
                        color: '#FFD166',
                        weight: 3
                    };
                },
                onEachFeature: function(feature, layer) {


                    var routeDelete = "{{ route('polylines.destroy', ':id') }}";
                    routeDelete = routeDelete.replace(':id', feature.properties.id);

                    var routeEdit = "{{ route('polylines.edit', ':id') }}";
                    routeEdit = routeEdit.replace(':id', feature.properties.id);

                    var popupContent = "Nama: " + feature.properties.name + "<br>" +
                        "Deskripsi: " + feature.properties.description + "<br>" +
                        "Panjang(Km) : " + feature.properties.length_km + "<br>" +
                        "Dibuat: " + feature.properties.created_at + "<br>" +
                        "<img src='{{ asset('storage/images') }}/" + feature.properties.image +
                        "' width='200' alt=''>" + "<br>" +
                        "<div class='row mt-2'>" +
                        "<div class='col-5 text-end'>" +
                        "<a href='" + routeEdit +
                        "' class='btn btn-warning btn-sm'><i class='fa-solid fa-pen-to-square'></i> Edit</a>" +
                        "</div>" +
                        "<div class='col-6'>" +
                        "<form method='POST' action='" + routeDelete + "'>" +
                        '@csrf' + '@method('DELETE')' +
                        "<button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(`Are you sure?`)'><i class='fa-solid fa-trash-can'></i> Hapus</button>" +
                        "</form>" +
                    "</div>" + "<br>" + "<p>Created by: " + feature.properties.user_created + "</p>";;
                    layer.on({
                        click: function(e) {
                            layer.bindPopup(popupContent).openPopup();
                        },
                        mouseover: function(e) {
                            layer.bindTooltip(feature.properties.name).openTooltip();
                        },
                    });
                },
            });
            $.getJSON("{{ route('api.polyline') }}", function(data) {
                polyline.addData(data);
                map.addLayer(polyline);
            });


            // GeoJSON POLYGON
            var polygon = L.geoJson(null, {
                style: function(feature) {
                    return {
                        color: '#F72585',
                        fillColor: '#CDB4DB',
                        fillOpacity: 0.8,
                        weight: 2
                    };
                },
                onEachFeature: function(feature, layer) {

                    var routeEdit = "{{ route('polygons.edit', ':id') }}";
                    routeEdit = routeEdit.replace(':id', feature.properties.id);

                    var routeDelete = "{{ route('polygons.destroy', ':id') }}";
                    routeDelete = routeDelete.replace(':id', feature.properties.id);

                    var popupContent = "Nama: " + feature.properties.name + "<br>" +
                        "Deskripsi: " + feature.properties.description + "<br>" +
                        "Luas(Km2) : " + feature.properties.area_km2 + "<br>" +
                        "Dibuat: " + feature.properties.created_at + "<br>" +
                        "<img src='{{ asset('storage/images') }}/" + feature.properties.image +
                        "' width='200' alt=''>" + "<br>" +
                        "<div class='row mt-2'>" +
                        "<div class='col-5 text-end'>" +
                        "<a href='" + routeEdit +
                        "' class='btn btn-warning btn-sm'><i class='fa-solid fa-pen-to-square'></i> Edit</a>" +
                        "</div>" +
                        "<div class='col-6'>" +
                        "<form method='POST' action='" + routeDelete + "'>" +
                        '@csrf' + '@method('DELETE')' +
                        "<button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(`Are you sure?`)'><i class='fa-solid fa-trash-can'></i> Hapus</button>" +
                        "</form>" +
                    "</div>" + "<br>" + "<p>Created by: " + feature.properties.user_created + "</p>";;
                    layer.on({
                        click: function(e) {
                            layer.bindPopup(popupContent).openPopup();
                        },
                        mouseover: function(e) {
                            layer.bindTooltip(feature.properties.name).openTooltip();
                        },
                    });
                },
            });
            $.getJSON("{{ route('api.polygon') }}", function(data) {
                polygon.addData(data);
                map.addLayer(polygon);
            });



            // Control Layer
            var overlayMaps = {
                "points": points,
                "polyline": polyline,
                "polygon": polygon,
            };

            var controllayer = L.control.layers(overlayMaps);
            controllayer.addTo(map);
        </script>
    @endsection
