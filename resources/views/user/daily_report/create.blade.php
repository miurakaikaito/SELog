@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報作成</h2>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'report.store']) !!}
      <div class="form-group @if ($errors->has('reporting_time')) has-error @endif form-size-small">
        {!! Form::date('reporting_time', null, ['class' => 'form-control']) !!}
        @if ($errors->has('reporting_time'))
          <span class="help-block">{{ $errors->first('reporting_time') }}</span>
        @endif
      </div>
      <div class="form-group @if ($errors->has('title')) has-error @endif">
        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
        @if ($errors->has('title'))
          <span class="help-block">{{ $errors->first('title') }}</span>
        @endif
      </div>
      <div class="form-group @if ($errors->has('contents')) has-error @endif">
        {!! Form::textarea('contents', null, ['class' => 'form-control', 'placeholder' => 'Content']) !!}
        @if ($errors->has('contents'))
          <span class="help-block">{{ $errors->first('contents') }}</span>
        @endif
      </div>
      {!! Form::button('Add', ['class' => 'btn btn-success pull-right', 'type' =>'submit']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection
