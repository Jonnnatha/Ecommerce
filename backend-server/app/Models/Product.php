<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'images' => 'json',
    ];

    public function scopeConditions($query, $type)
    {
        $query->where('conditions', $type);
    }


    public function scopeSold($query)
    {
        $query->where('sale', 1);
    }

    public function scopePublished($query)
    {
        $query->where('status', 'active');
    }


    public function wishlistUsers()
    {
        return $this->belongsToMany(User::class, 'wishlists')->withTimestamps();;
    }


    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
}
