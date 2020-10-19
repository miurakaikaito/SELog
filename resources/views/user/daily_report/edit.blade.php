@extends ('common.user')
@section ('content')

<h1 class="brand-header">日報編集</h1>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => ['report.update', $report->id], 'method' => 'PUT']) !!}
      <div class="form-group form-size-small @if ($errors->has('reporting_time')) has-error @endif">
        {!! Form::date('reporting_time', $report->reporting_time->format('Y-m-d'), ['class' => 'form-control']) !!}
        @if ($errors->has('reporting_time'))
          <span class="help-block">{{ $errors->first('reporting_time') }}</span>
        @endif
      </div>
      <div class="form-group @if ($errors->has('title')) has-error @endif">
        {!! Form::text('title', $report->title, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
        @if ($errors->has('title'))
          <span class="help-block">{{ $errors->first('title') }}</span>
        @endif
      </div>
      <div class="form-group @if ($errors->has('contents')) has-error @endif">
        {!! Form::textarea('contents', $report->contents, ['class' => 'form-control', 'placeholder' => 'Contents']) !!}
        @if ($errors->has('contents'))
          <span class="help-block">{{ $errors->first('contents') }}</span>
        @endif
      </div>
      {!! Form::button('Update', ['class' => 'btn btn-success pull-right', 'type' =>'submit']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection
