<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Slider extends Model
{
    use HasFactory;
    protected $table = 'slider';
    protected $fillable = [
        'name',
        'active',
        'weight',
        'image',
    ];

    public static function uploadImage(Request $request, $image = null){
        if($request->hasFile('image')){
            if ($image) {
                Storage::delete($image);
            }
            return $request->file('image')->store('slider');
        }
        return null;
    }

    public function getSlider(){
        if(!$this->image){
            return asset('no-image.png');
        }
        return asset('/images/'.$this->image);
    }

    /*public function setActiveAttribute($value)
    {
        $this->attributes['active'] = ($value=='on') ? ($value=1) : ($value=0);
    }*/
}
