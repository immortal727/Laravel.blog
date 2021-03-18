<?php

namespace App\Models;

use App\Http\Requests\StorePost;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'name',
        'title',
        'description',
        'quote',
        'content',
        'category_id',
        'thumbnail',
        'view'
    ];

    public function tags(){
        // Связь - Многие ко многим (Many-to-many)
        // Используем метод withTimestamps()
        // чтоб автоматически заполнялись поля created_at и updated_at
        // в промежуточной табилце post_tag
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function category(){
        // Используем уже обратное отношение
        return $this->belongsTo(Category::class);
    }

    /* Альбомы, принадлежащие данному посту*/
    public function albums()
    {
        return $this->belongsToMany(Album::class);
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public static function uploadImage(StorePost $request, $image = null){
        if($request->hasFile('thumbnail')){
            if ($image) {
                Storage::delete($image);
            }
            $folder = date('Y-m-d');
            return $request->file('thumbnail')->store("{$folder}");
        }
        return null;
    }

    public function getImage(){
        if(!$this->thumbnail){
            return asset('no-image.png');
        }
        return asset('images/'.$this->thumbnail);
    }

    public function getPostDate(){
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d F Y');
    }

    public static function translit($string){
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
            'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        );
        return strtr($string, $converter);
    }

    public static function MakeUrlCode($str){
        return trim(preg_replace('~[^-a-z0-9_]+~u', '-', strtolower(self::translit($str))), "-");
    }
}
