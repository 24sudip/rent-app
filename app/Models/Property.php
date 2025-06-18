<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * Get the user that owns the Property
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class, 'upazilla_id', 'id');
    }
    /**
     * Get all of the rooms for the Property
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rooms()
    {
        return $this->hasMany(Room::class, 'property_id', 'id');
    }
    public function room_types()
    {
        return $this->hasMany(Room::class, 'property_id', 'id');
    }

    public function amenities()
    {
        return $this->hasMany(Amenity::class, 'property_id', 'id');
    }

    public function rent_packages()
    {
        return $this->hasMany(RentPackage::class, 'property_id', 'id');
    }

    public function rent_terms()
    {
        return $this->hasMany(RentTerm::class, 'property_id', 'id');
    }

    public function property_rules()
    {
        return $this->hasMany(PropertyRule::class, 'property_id', 'id');
    }
    /**
     * Get the division that owns the Property
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }
    /**
     * Get all of the multi_images for the Property
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function multi_images()
    {
        return $this->hasMany(MultiImage::class, 'property_id', 'id');
    }
    /**
     * Get the user that owns the Property
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manager()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

