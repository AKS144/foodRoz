<?php

namespace App\Models;

use App\Scopes\RestaurantScope;
use App\Scopes\ZoneScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Food extends Model
{
    protected $casts = [
        'tax' => 'float',
        'price' => 'float',
        'sell_price' => 'float',
        'status' => 'integer',
        'discount' => 'float',
        'set_menu' => 'integer',
        'category_id' => 'integer',
        'restaurant_id' => 'integer',
        'reviews_count' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'veg'=>'integer'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1)->whereHas('restaurant', function($query){
            return $query->where('status', 1);
        });
    }

    public function scopePopular($query)
    {
        return $query->orderBy('order_count', 'desc');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->latest();
    }

    public function rating()
    {
        return $this->hasMany(Review::class)
            ->select(DB::raw('avg(rating) average, count(food_id) rating_count, food_id'))
            ->groupBy('food_id');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    
    public function orders()
    {
        return $this->hasMany(OrderDetail::class);
    }

    
    public function getCategoryAttribute()
    {
        $category=Category::find(json_decode($this->category_ids)[0]->id);
        return $category?$category->name:trans('messages.uncategorize');
    }

    protected static function booted()
    {
        if(auth('vendor')->check())
        {
            static::addGlobalScope(new RestaurantScope);
        } 

        static::addGlobalScope(new ZoneScope);
    }


    public function scopeType($query, $type)
    {
        if($type == 'veg')
        {
            return $query->where('veg', true);
        }
        else if($type == 'non_veg')
        {
            return $query->where('veg', false);
        }
        
        return $query;
    }
    
}
