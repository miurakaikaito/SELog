<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagCategory extends Model
{
    public function questions()
    {
        return $this->hasMany('App\Models\Question');
    }

    public function getTagCategories()
    {
        return $this->get();
    }

    public function getTagCategoryNames($input)
    {
        return $this->where('id', $input)->value('name');
    }
}
