<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\PolylineModel;

class PolylineController extends Controller
{
    public function __construct()
    {
        $this->polyline = new PolylineModel();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //Validate request
        $request->validate(
            [
                'name' => 'required|unique:polyline,name',
                'description' => 'required',
                'geom_polyline' => 'required',
                'image' => 'nullable|max:200|mimes:jpeg,png,jpg,gif,svg'
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exist',
                'description.required' => 'Description is required',
                'geom_polyline.required' => 'Geometry polyline is required',
            ]
        );

        //create image directory if not exist
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
         }

         //Get Image File
         if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_polyline." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
          } else {
            $name_image = null;
          }

        $data = [
            'geom' => $request->geom_polyline,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image,
            'user_id' => auth()->user()->id,
        ];

        // Create data
        if (!$this->polyline->create($data)) {
            return redirect()->route('map')->with('error', 'Polyline failed to add');
        }

        //Redirect data
        return redirect()->route('map')->with('success', 'polyline has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'title' => 'Edit Polyline',
            'id' => $id,
        ];

        return view('edit-polyline', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Validate request
        $request->validate(
            [
                'name' => 'required|unique:polyline,name,' . $id,
                'description' => 'required',
                'geom_polyline' => 'required',
                'image' => 'nullable|max:200|mimes:jpeg,png,jpg,gif,svg'
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exist',
                'description.required' => 'Description is required',
                'geom_polyline.required' => 'Geometry polyline is required',
            ]
        );

        //create image directory if not exist
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        //Get Old Image File name
        $old_image = $this->polyline->find($id)->image;


        //Get Image File
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_polyline." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);

            //Delete old image
            if ($old_image != null) {
                if (file_exists('./storage/images/' . $old_image)) {
                    unlink('./storage/images/' . $old_image);
                }
            }
        } else {
            $name_image = $old_image;
        }

        $data = [
            'geom' => $request->geom_polyline,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image,
        ];

        // Create data
        if (!$this->polyline->find($id)->update($data)) {
            return redirect()->route('map')->with('error', 'polyline failed to update');
        }

        //Redirect data
        return redirect()->route('map')->with('success', 'polyline has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imagefile = $this->polyline->find($id)->image;

        if (!$this->polyline->destroy($id)) {
        return redirect ()->route('map')->with('error', 'Polyline failed to delete');
        }

        //delete image file
        if($imagefile !=null){
            if(file_exists('./storage/images/' . $imagefile)){
                unlink('./storage/images/' .$imagefile);
            }
        }

        return redirect ()->route('map')->with('success', 'Polyline has been deleted');
    }
}
