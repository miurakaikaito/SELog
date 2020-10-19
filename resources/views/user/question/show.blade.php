@extends ('common.user')
@section ('content')

<h1 class="brand-header">質問詳細</h1>
<div class="main-wrap">
  <div class="panel panel-success">
    <div class="panel-heading">
      <img src="{{ Auth::user()->avatar }}" class="avatar-img">
      <p>{{ Auth::user()->name }}&nbsp;さんの質問&nbsp;&nbsp;(&nbsp;{{ $question->tagCategory->name }}&nbsp;)</p>
      <p class="question-date">{{ $question->created_at }}</p>
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <tbody>
          <tr>
            <th class="table-column">Title</th>
            <td class="td-text">{{ $question->title }}</td>
          </tr>
          <tr>
            <th class="table-column">Question</th>
            <td class='td-text'>{!! nl2br(e($question->content)) !!}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
    <div class="comment-list">
        @foreach ($comments as $comment)
          <div class="comment-wrap">
            <div class="comment-title">
              <img src="{{ $comment->user->avatar }}" class="avatar-img">
              <p>{{ $comment->user->name }}</p>
              <p class="comment-date">{{ $comment->created_at }}</p>
            </div>
            <div class="comment-body">{!! nl2br(e($comment->content)) !!}</div>
          </div>
        @endforeach
    </div>
  <div class="comment-box">
    {!! Form::open(['route' => 'comment.store']) !!}
      {!! Form::hidden('question_id', $question->id) !!}
      <div class="comment-title">
        <img src="{{ Auth::user()->avatar }}" class="avatar-img"><p>コメントを投稿する</p>
      </div>
      <div class="comment-body @if ($errors->has('question_id') || $errors->has('content')) has-error @endif">
        {!! Form::textarea('content', null, [
          'class' => 'form-control',
          'placeholder' => 'Add your comment...'
        ]) !!}
        @if ($errors->has('content'))
          <span class="help-block">{{ $errors->first('content') }}</span>
        @elseif ($errors->has('question_id'))
          <span class="help-block">{{ $errors->first('question_id') }}</span>
        @endif

      </div>
      <div class="comment-bottom">
        {!! Form::button('<i class="fa fa-pencil" aria-hidden="true"></i>',
                          ['class' => 'btn btn-success', 'type' => 'submit']
                        )
        !!}
      </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection