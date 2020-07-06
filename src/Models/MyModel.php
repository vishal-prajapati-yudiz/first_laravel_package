<?php

namespace Spatie\Skeleton\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MyModel extends Model
{
    use SoftDeletes;
    protected $table = "contact_us";
    
    protected $fillable = [
        'name', 'email', 'contact', 'message',
    ];

    protected $guarded = [];

    public function getUpperCaseName(): string
    {
        return strtoupper($this->name);
    }
}
