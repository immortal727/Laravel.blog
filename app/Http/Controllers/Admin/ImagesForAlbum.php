<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Album;

class ImagesForAlbum extends Controller
{
    public function addImages(Request $request, $id){
        $request->validate([
             'multi_image' => 'image',
        ]);
        $data = $request->all();

        if(!empty($request->file('file'))){
            Images::uploadMultiImg($request, $request->file('file'), $id, $data);
        }

        return response()->json([
            'status' => 'ok'
        ]);
    }

    public function destroy($id){
        $img = Images::find($id);
        $album =  $img->album_id;
        $file = '/albums/'.$album.'/'.$img->image;
        $exists = Storage::disk('public')->exists($file);
        if($exists){
            Storage::delete($file);
        }
        $img->delete();
        $album = Album::with('Photos')->find($album);
        return view('admin.albums.album', compact('album'));
    }
}
