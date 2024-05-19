<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Emploi;
use App\Models\User;
use App\Models\proposal;

class CoverLetter extends Model
{
    use HasFactory;
    protected $table = 'cover_letters';

    protected $fillable = ['proposal_id', 'content'];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    
}
