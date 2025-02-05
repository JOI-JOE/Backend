<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    use HasFactory;

    // $fillable mới có thể được gán giá trị từ request.
    protected $fillable = [
        'team_type_id',
        'id_member_creator',
        'desc',
        'display_name',
        'name',
        'logo_hash',
        'logo_url',
        'visibility',
        'is_archived',
    ];

    public function teamType()
    {
        return $this->belongsTo(TeamType::class);
    }
}
