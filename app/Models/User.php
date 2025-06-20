<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const VISIBILITY_ALL = 'all';
    const VISIBILITY_PREMIUM = 'premium';

    const REQUEST_ALL = 'all';
    const REQUEST_PREMIUM = 'premium';

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function currentPackage()
    {
        $userPackage = $this->hasOne(UserPackage::class)
            ->where('expired_at', '>', now())
            ->latest()
            ->with('package')
            ->first();

        if (!$userPackage) {
            $defaultPackage = Package::where('price', 0)->first();
            return $defaultPackage;
        }

        return $userPackage->package;
    }

    public function assignPackage($package)
    {
        return $this->userPackages()->create([
            'package_id' => $package->id,
            'expired_at' => now()->addDays($package->duration),
        ]);
    }

    public function hasAccessTo($feature)
    {
        $package = $this->currentPackage();
        $accesses = $package ? $package->accesses->pluck('name')->toArray() : [];

        return in_array($feature, $accesses);
    }

    public function profileViews() {
        return $this->hasMany(ProfileView::class, 'user_id');
    }

    public function profileLikes() {
        return $this->hasMany(ProfileLike::class, 'user_id');
    }

    public function profileClicks() {
        return $this->hasMany(ProfileClick::class, 'user_id');
    }

    public function invitations()
    {
        return Invitation::where(function ($query) {
            $query->where('sent_from', $this->id)
                ->orWhere('sent_to', $this->id);
        });
    }


    public function canReceiveInterestRequests()
    {
        return $this->interest_request_access === self::REQUEST_ALL ||
                ($this->interest_request_access === self::REQUEST_PREMIUM && $this->isPremium());
    }

    public function canViewProfile($viewer)
    {
        return $this->profile_visibility === self::VISIBILITY_ALL ||
               ($this->profile_visibility === self::VISIBILITY_PREMIUM && $viewer->isPremium());
    }

    public function isPremium()
    {
        return $this->currentPackage() && $this->currentPackage()->price>0;
    }
    /**
     * Get the property_category that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function property_category()
    {
        return $this->belongsTo(PropertyCategory::class, 'property_category_id', 'id');
    }
}
