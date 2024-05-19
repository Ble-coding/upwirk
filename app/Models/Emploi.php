<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Proposal;
class Emploi extends Model
{
    use HasFactory;

    protected $table = 'emplois';
    protected $fillable = [
        'title',
        'description',
        'price',
        'attachment',
        'status',
        'user_id',
    ];

    public function scopeOnline($query)
    {
        return $query->where('status', 1);
    }
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = auth()->user()->id;
        });
    }
    
    /**
     * Get the user that owns the job.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class);
    }

    public function isLiked()
    {
        if (!auth()->check()) {
            return false;
        }
        return auth()->user()->likes->contains('id', $this->id);
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    
}
