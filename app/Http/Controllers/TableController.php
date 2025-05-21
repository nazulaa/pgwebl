<?php

namespace App\Http\Controllers;

use view;
use App\Models\PointsModel;
use App\Models\PolygonModel;
use Illuminate\Http\Request;
use App\Models\PolylineModel;

class TableController extends Controller
{

    public function __construct()
    {
        $this->points = new PointsModel();
        $this->polyline = new PolylineModel();
        $this->polygon = new PolygonModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Table',
            'points' => $this->points->all(),
            'polyline' => $this->polyline->all(),
            'polygon' => $this->polygon->all(),
        ];

        return view('table', $data);
    }
}
