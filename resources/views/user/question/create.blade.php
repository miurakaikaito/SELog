@extends ('common.user')
@section ('content')

<h2 class="brand-header">質問投稿</h2>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'question.confirm']) !!}
      <div class="form-group @if ($errors->has('tag_category_id')) has-error @endif">
        {!! Form::select('tag_category_id',
                          $tagCategories,
                          null,
                          [
                            'id' => 'pref_id',
                            'class' => 'form-control selectpicker form-size-small',
                            'placeholder' => 'Select category'
                          ]
                        )
        !!}
        @if ($errors->has('tag_category_id'))
          <span class="help-block">{{ $errors->first('tag_category_id') }}</span>
        @endif
      </div>
      <div class="form-group @if ($errors->has('title')) has-error @endif">
        {!! Form::text('title', null, ['class'=> 'form-control', 'placeholder' => 'title']) !!}
        @if ($errors->has('title'))
          <span class="help-block">{{ $errors->first('title') }}</span>
        @endif
      </div>
      <div class="form-group @if ($errors->has('content')) has-error @endif">
        {!! Form::textarea('content',
                            null,
                            [
                              'class'=> 'form-control',
                              'placeholder' => 'Please write down your question here...'
                            ]
                          )
        !!}
        @if ($errors->has('content'))
          <span class="help-block">{{ $errors->first('content') }}</span>
        @endif
      </div>
      {!! Form::submit('create', ['name' => 'confirm', 'class' => 'btn btn-success pull-right']) !!}
    {{ Form::close() }}
  </div>
</div>

@endsection