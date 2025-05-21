<?php

namespace App\Http\Controllers;

use App\Models\PointsModel;
use App\Models\PolygonModel;
use Illuminate\Http\Request;
use App\Models\PolylineModel;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->points = new PointsModel();
        $this->polyline = new PolylineModel();
        $this->polygon = new PolygonModel();
    }
    public function points()
    {
        $points = $this->points->geojson_points();

        return response()->json($points);
    }
    public function point($id) #SATU
    {
        $points = $this->points->geojson_point($id);

        return response()->json($points);
    }
    public function polyline()
    {
        $polyline = $this->polyline->geojson_polyline();

        return response()->json($polyline);
    }
    public function polylinee($id) #SATU
    {
        $polyline = $this->polyline->geojson_polylinee($id);

        return response()->json($polyline);
    }

    public function polygon()
    {
        $polygon = $this->polygon->geojson_polygon();

        return response()->json($polygon);
    }
    public function polygonn($id) #SATU
    {
        $polygon = $this->polygon->geojson_polygonn($id);

        return response()->json($polygon);
    }
}

