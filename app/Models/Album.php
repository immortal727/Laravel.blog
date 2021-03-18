<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class Album extends Model
{
    use HasFactory;
  //  protected $table = 'albums';

    protected $fillable = [
        'name',
        'description',
        'cover_image',
        ];

    public function Photos(){
        return $this->hasMany(Images::class);
    }

    /* Посты, принадлежащие данному альбому*/
    public function Posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public static function uploadImage(Request $request, $image = null)
    {
        if ($request->hasFile('cover_image')) {
            if ($image) {
                Storage::delete('/albums/'.$image);
            }
            $file = $request->file('cover_image');
            $extension = $file->extension();
            $random_name = Str::random(8);
            $filename = $random_name . '_cover.' . $extension;
            $destinationPath = config('app.CVDestinationPath')."/albums/".$filename;
            Storage::put($destinationPath, file_get_contents($file->getRealPath()));
            return $filename;
        }
        return null;
    }

    public function getImage(){
        if(!$this->cover_image){
            return asset('no-image.png');
        }
        return asset('images/albums/'.$this->cover_image);
    }
}
