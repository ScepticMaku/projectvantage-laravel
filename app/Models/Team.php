<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_name',
        'description',
        'project_id',
    ];

    public function project() {
        return $this->belongsTo(Project::class);
    }
}
