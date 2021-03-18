<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Images extends Model
{
    use HasFactory;
    // protected $table = 'images';

    protected $fillable = [
        'album_id',
        'description',
        'image'];

    public static function uploadMultiImg(Request $request, $images = null, $album, $data){
        if($request->hasFile('file')){
            foreach($images as $key=>$file){
                $extention = $file->getClientOriginalExtension();
                $fileName = sha1_file($file)."-$album".".".$extention;
                $destinationPath = config('app.CVDestinationPath')."/albums/$album/".$fileName;
                Storage::put($destinationPath, file_get_contents($file->getRealPath()));
                $images[$key] = $fileName;
                $data['image'] = $fileName;
                Images::create($data);
            }
            return $images;
        }
        return null;
    }
}
