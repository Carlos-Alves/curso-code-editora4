{!!  Form::hidden('redirect_to', URL::previous()) !!}
{!! Html::openFormGroup('name', $errors) !!}
    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    {!! Form::error('name', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('email', $errors) !!}
    {!! Form::label('email', 'E-mail', ['class' => 'control-label']) !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
    {!! Form::error('email', $errors) !!}
{!! Html::closeFormGroup() !!}


{!! Html::openFormGroup(['roles.*'], $errors) !!}
{!! Form::label('roles[]', 'Roles', ['class' => 'control-label']) !!}
{!! Form::select('roles[]', $roles,null, ['class' => 'form-control', 'multiple'=>true]) !!}
{!! Form::error('roles.*', $errors) !!}
{!! Html::closeFormGroup() !!}

