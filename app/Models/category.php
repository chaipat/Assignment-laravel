<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = 'categories';

    protected $primaryKey = 'category_id'; // Specify the primary key

    public $incrementing = true; // The primary key is auto-incrementing
    protected $keyType = 'int'; // The primary key is of type integer

    protected $fillable = ['category_name', 'parent_id'];

    // Define a relationship to get subcategories
    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'category_id');
    }
}
