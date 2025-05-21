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
        <div class="modal fade" id="editpointModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Point</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('point.update', $id) }}" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            @method('PATCH')
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
                draw: false,
                edit: {
                    featureGroup: drawnItems,
                    edit: true,
                    remove: false
                }
            });

            map.addControl(drawControl);

            map.on('draw:edited', function(e) {
                var layers = e.layers;

                layers.eachLayer(function(layer) {
                    var drawnJSONObject = layer.toGeoJSON();
                    console.log(drawnJSONObject);

                    var objectGeometry = Terraformer.geojsonToWKT(drawnJSONObject.geometry);
                    console.log(objectGeometry);

                    // layer properties
                    var properties = drawnJSONObject.properties;
                    console.log(properties);

                    drawnItems.addLayer(layer);

                    //menampilkan data ke dalam modal
                    $('#name').val(properties.name);
                    $('#description').val(properties.description);
                    $('#geom_point').val(objectGeometry);
                    $('#preview-image-point').attr('src', "{{ asset('storage/images') }}/" + properties.image);

                    //menampilkan modal edit
                    $('#editpointModal').modal('show');
                });
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

                    // memasukkan layer point ke dalam drawnItems
                    drawnItems.addLayer(layer);

                    var properties = feature.properties;
                    var objectGeometry = Terraformer.geojsonToWKT(feature.geometry);

					layer.on({
						click: function (e) {
                            // menampilkan data ke dalam modal
                            $('#name').val(properties.name);
                            $('#description').val(properties.description);
                            $('#geom_point').val(objectGeometry);
                            $('#preview-image-point').attr('src', "{{ asset('storage/images')}}/" + properties.image);

                            // menampilkan modal edit point
                            $('#editpointModal').modal('show');
						},
					});
                },
            });
            $.getJSON("{{ route('api.point', $id) }}", function(data) {
                points.addData(data);
                map.addLayer(points);
                map.fitBounds(points.getBounds(), {
                    padding: [100, 100]
                });
            });
        </script>
    @endsection
