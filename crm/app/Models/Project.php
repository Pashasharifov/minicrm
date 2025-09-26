<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'status',
        'user_id',
        "client_id",
        "description",
        "deadline_at",
        "status"
    ];
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function client(){
        return $this->belongsTo(Client::class);
    }
    protected function casts(): array{
        return [
            'status'=>ProjectStatus::class
        ];
    }
}
