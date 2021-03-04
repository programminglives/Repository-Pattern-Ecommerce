<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return 'hi';
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);

//        $imageUpload = new ImageUpload();
//        $imageUpload->filename = $imageName;
//        $imageUpload->save();
//        return response()->json(['success'=>$imageName]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request){
        try{
            $image = Image::findOrFail($request->key);
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }catch (\Exception $exception){
            return response(['There was some problem. Contact System Administrator.'],500);
        }
        return response(['Image was successfully deleted'],200);
    }
}
