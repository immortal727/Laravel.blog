<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = [
        'parent_id',
        'name',
        'url',
        'live',
        'sort_order',
        'post_id',
        'category_id',
        'type',
        'home'
    ];
    public $timestamps = false;

    public function scopeIsLive($query)
    {
        return $query->where('live', true);
    }

    public function scopeOfSort($query, $sort)
    {
        foreach ($sort as $column => $direction) {
            $query->orderBy($column, $direction);
        }
        return $query;
    }

    public function parent()
    {
        /* Один ко многим (обртаное отношение)*/
        /* много вложенных пунктов относятся к одному родителю */
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children()
    {
        /* Один ко многим */
        /* у одного родителя может быть много вложенных пунктов */
        return $this->hasMany(self::class, 'parent_id');
    }

    public static function val_home(){
        $home = Menu::where('home', 1)->first('home');
        return $home['home'];
    }
}
