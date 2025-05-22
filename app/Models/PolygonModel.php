<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PolygonModel extends Model
{
    protected $table = 'polygon';

    protected $guarded = ['id'];

    public function geojson_polygon()
    {
        $polygon = $this->select(DB::raw('polygon.id, st_asgeojson(geom) as geom, polygon.name, polygon.description, polygon.image,
        st_area(geom, true) as area_m2, st_area(geom, true)/1000000 as area_km2, polygon.created_at, polygon.updated_at, polygon.user_id, users.name as user_created'))
        ->leftJoin('users','polygon.user_id', '=', 'users.id')
        ->get();


        $geojson = [
            'type'=> 'FeatureCollection',
            'features' => [],
        ];
        foreach ($polygon as $p) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom),
                'properties' => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'area_m2' => $p->area_m2,
                    'area_km2' => $p->area_km2,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                    'image' => $p->image,
                    'user_created' => $p->user_created,
                    'user_id'=>$p->user_id,
                ],
            ];
            array_push($geojson['features'], $feature);
        }
        return $geojson;
    }
    public function geojson_polygonn($id)
    {
        $polygon = $this->select(DB::raw('id, st_asgeojson(geom) as geom, name, description, image,
        st_area(geom, true) as area_m2, st_area(geom, true)/1000000 as area_km2, created_at, updated_at, '))
        ->where('id', $id)
        ->get();


        $geojson = [
            'type'=> 'FeatureCollection',
            'features' => [],
        ];
        foreach ($polygon as $p) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom),
                'properties' => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'area_m2' => $p->area_m2,
                    'area_km2' => $p->area_km2,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                    'image' => $p->image,
                ],
            ];
            array_push($geojson['features'], $feature);
        }
        return $geojson;
    }
}
