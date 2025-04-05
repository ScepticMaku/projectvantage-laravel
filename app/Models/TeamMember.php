<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'user_id',
        'role_id',
        'status_id',
    ];

    public function team() {
        return $this->belongsTo(Team::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function teamMemberStatus() {
        return $this->belongsTo(TeamMemberStatus::class);
    }
}
