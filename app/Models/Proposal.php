<?php

namespace App\Models;
use App\Models\CoverLetter;
use App\Models\Conversation; 
use App\Models\Emploi;       
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;
    protected $table = 'proposals';
    protected $fillable = ['emploi_id', 'user_id', 'validated'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = auth()->user()->id;
        });
    }

    public function coverLetter()
    {
        return $this->hasOne(CoverLetter::class);
    }
    public function conversation()
    {
        return $this->hasOne(Conversation::class);
    }
    public function emploi()
    {
        return $this->belongsTo(Emploi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeProposalCoverLetter($query)
    {
        return $query->select('content')
            ->from('cover_letters')
            ->join('proposals', 'cover_letters.proposal_id', '=', 'proposals.id')
            ->where('proposal_id', $this->id)
            ->first()
            ->content;
    }
}
