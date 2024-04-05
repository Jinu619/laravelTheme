<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submenu extends Model
{
    protected $table = "_submenu";
    use SoftDeletes;

    protected $fillable = [
        'title',
        'link',
        'menu_id',
        'listing_order'
    ];
    public function menu()
    {
        return $this->belongsTo('App\Models\Menu', 'menu_id');
    }
}
