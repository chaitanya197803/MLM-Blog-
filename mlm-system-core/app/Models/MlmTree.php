<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MlmTree extends Model
{
    use HasFactory;

    protected $table = 'mlm_tree';

    protected $fillable = [
        'user_id',
        'parent_id',
        'level',
    ];

    /**
     * Get the user associated with this tree node.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parent user associated with this tree node.
     */
    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }
}
