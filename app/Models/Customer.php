<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address'
    ];

    /**
     * Get the web projects for the customer.
     */
    public function webProjects(): HasMany
    {
        return $this->hasMany(WebProject::class);
    }

     /**
     * Get the mobile projects for customer.
     */
    public function mobileProjects(): HasMany
    {
        return $this->hasMany(MobileProject::class);
    }

    /**
     * Get the desktop projects for the customer.
     */
    public function desktopProjects(): HasMany
    {
        return $this->hasMany(DesktopProject::class);
    }
}
