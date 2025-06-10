<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Enums\DepartmentsEnum;
class CompanyRepresentative extends Model
{
    use HasFactory;
    protected $fillable = [
      'first_name',
      'last_name',
      'department',
    ];

    protected $casts = [
        'first_name' => 'string',
        'last_name' => 'string',
        'department' => DepartmentsEnum::class,
    ];


    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class);
    }
}
