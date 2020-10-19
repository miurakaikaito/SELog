<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\QuestionsRequest;
use App\Models\Question;
use App\Models\TagCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    private $question;

    private $tagCategory;

    public function __construct(Question $question, TagCategory $tagCategory)
    {
        $this->middleware('auth');
        $this->question = $question;
        $this->tagCategory = $tagCategory;
    }

    public function index(Request $request)
    {
        $inputs = $request->input();
        $tagCategories = $this->tagCategory->getTagCategories();
        $questions = $this->question->getQuestions($inputs);
        return view('user.question.index', compact('tagCategories', 'questions', 'inputs'));
    }

    public function create()
    {
        $tagCategories = $this->tagCategory->getTagCategories()->pluck('name', 'id');
        return view('user.question.create', compact('tagCategories'));
    }

    public function confirm(QuestionsRequest $request)
    {
        $input = $request->input();
        $input['user_id'] = Auth::id();
        $categoryName = $this->tagCategory->getTagCategoryNames($input['tag_category_id']);
        return view('user.question.confirm', compact('input', 'categoryName'));
    }

    public function store(QuestionsRequest $request)
    {
        $inputs = $request->input();
        $inputs['user_id'] = Auth::id();
        $this->question->saveQuestion($inputs);
        return redirect()->route('question.mypage');
    }

    public function show($questionId)
    {
        $question = $this->question->findQuestion($questionId);
        $comments = $question->comments()->with('user')->get();
        return view('user.question.show', compact('question', 'comments'));
    }

    public function showMyPage()
    {
        $myQuestions = $this->question->getMyQuestions();
        return view('user.question.mypage', compact('myQuestions'));
    }

    public function edit($questionId)
    {
        $tagCategories = $this->tagCategory->getTagCategories()->pluck('name', 'id');
        $question = $this->question->findQuestion($questionId);
        return view('user.question.edit', compact('question', 'tagCategories'));
    }

    public function update(QuestionsRequest $request, $questionId)
    {
        $inputs = $request->input();
        $this->question->updateQuestion($questionId, $inputs);
        return redirect()->route('question.mypage');
    }

    public function destroy($questionId)
    {
        $this->question->deleteQuestion($questionId);
        return redirect()->route('question.mypage');
    }
}
