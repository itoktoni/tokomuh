<div class="form-group">

    {!! Form::label('name', 'Name', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has($form.'name') ? 'has-error' : ''}}">
        {!! Form::text($form.'name', null, ['class' => 'form-control', 'autofocus']) !!}
        {!! $errors->first($form.'name', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', 'Value', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has($form.'value') ? 'has-error' : ''}}">
        {!! Form::text($form.'value', null, ['class' => 'form-control', 'autofocus']) !!}
        {!! $errors->first($form.'value', '<p class="help-block">:message</p>') !!}
    </div>

</div>
<div class="form-group">

    {!! Form::label('name', 'Type', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has($form.'type') ? 'has-error' : ''}}">
        {{ Form::select($form.'type', $status, null, ['class'=> 'form-control']) }}
        {!! $errors->first($form.'type', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', 'Description', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has($form.'description') ? 'has-error' : ''}}">
        {!! Form::textarea($form.'description', null, ['class' => 'form-control', 'rows' => 3]) !!}
        {!! $errors->first($form.'description', '<p class="help-block">:message</p>') !!}
    </div>
</div>