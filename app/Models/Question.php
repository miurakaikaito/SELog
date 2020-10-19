<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Question extends Model
{
    use softDeletes;

    protected $dates = [
        'reporting_time',
    ];

    protected $fillable = [
        'user_id',
        'tag_category_id',
        'title',
        'content'
    ];

    protected $perPage = 10;

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function tagCategory()
    {
        return $this->belongsTo('App\Models\TagCategory');
    }
    
    public function saveQuestion($attributes)
    {
        return $this->fill($attributes)->save();
    }

    public function findQuestion($questionId)
    {
        return $this->find($questionId);
    }

    public function getQuestions($inputs)
    {
        return $this->with(['tagCategory', 'comments'])
                    ->when(isset($inputs['tag_category_id']), function ($query) use ($inputs) {
                        return $query->where('tag_category_id', $inputs['tag_category_id']);
                    })
                    ->when(isset($inputs['search_word']), function ($query) use ($inputs) {
                        return $query->where('title', 'LIKE', '%' . $inputs['search_word'] . '%');
                    })
                    ->orderBy('created_at', 'desc')
                    ->paginate();
    }

    public function getMyQuestions()
    {
        return $this->with(['tagCategory', 'comments'])
                    ->where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->paginate();
    }

    public function updateQuestion($questionId, $validatedInputs)
    {
        $this->find($questionId)->fill($validatedInputs)->save();
    }

    public function deleteQuestion($questionId)
    {
        $this->find($questionId)->delete();
    }
}
