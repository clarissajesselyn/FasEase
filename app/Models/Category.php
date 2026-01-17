<?php

namespace App\Models;

use App\Models\Item;
use App\Trait\HasSlug;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasSlug;
    protected $fillable = [
        'name',
        'slug',
        'image',
        'organization_id',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function item(){
        return $this->hasMany(Item::class);
    }
}
