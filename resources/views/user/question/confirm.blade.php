@extends ('common.user')
@section ('content')

<h2 class="brand-header">投稿内容確認</h2>
<div class="main-wrap">
  <div class="panel panel-success">
    <div class="panel-heading">
      {{ $categoryName }}の質問
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <tbody>
          <tr>
            <th class="table-column">Title</th>
            <td class="td-text">{{ $input['title'] }}</td>
          </tr>
          <tr>
            <th class="table-column">Question</th>
            <td class='td-text'>{!! nl2br(e($input['content'])) !!}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="btn-bottom-wrapper">
    @if (isset($input['question_id']))
      {!! Form::open(['route' => ['question.update', $input['question_id']], 'method' => 'PUT']) !!}
        {!! Form::hidden('question_id', $input['question_id']) !!}
    @else
      {!! Form::open(['route' => 'question.store']) !!}
    @endif
      {!! Form::hidden('tag_category_id', $input['tag_category_id']) !!}
      {!! Form::hidden('title', $input['title']) !!}
      {!! Form::hidden('content', $input['content']) !!}
      {!! Form::button('<i class="fa fa-check" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection

