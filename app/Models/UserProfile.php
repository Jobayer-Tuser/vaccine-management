<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'nid',
        'name',
        'email',
        'phone',
        'status',
        'schedule_date',
        'vaccination_center_id',
    ];

    public function vaccineCenter(): BelongsTo
    {
        return $this->belongsTo(VaccineCenter::class);
    }
}
