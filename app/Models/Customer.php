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
     * Get the comments for the blog post.
     */
    public function webProjects(): HasMany
    {
        return $this->hasMany(WebProject::class);
    }

     /**
     * Get the comments for the blog post.
     */
    public function mobileProjects(): HasMany
    {
        return $this->hasMany(MobileProject::class);
    }

    /**
     * Get the comments for the blog post.
     */
    public function desktopProjects(): HasMany
    {
        return $this->hasMany(DesktopProject::class);
    }
}
