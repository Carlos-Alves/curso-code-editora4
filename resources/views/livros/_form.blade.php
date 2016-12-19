{!!  Form::hidden('redirect_to', URL::previous()) !!}

{!! Html::openFormGroup('user_id', $errors) !!}
{!! Form::label('user_id', 'Author: ') !!}
{!! Form::label('user_id', Auth::user()->name) !!}
{!! Form::hidden('user_id', Auth::user()->id, ['class' => 'form-control']) !!}
{!! Form::error('user_id', $errors) !!}
{!! Html::closeFormGroup() !!}


{!! Html::openFormGroup('title', $errors) !!}
{!! Form::label('title', 'Title') !!}
{!! Form::text('title', null, ['class' => 'form-control']) !!}
{!! Form::error('title', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('subtitle', $errors) !!}
{!! Form::label('subtitle', 'Subtitle') !!}
{!! Form::text('subtitle', null, ['class' => 'form-control']) !!}
{!! Form::error('subtitle', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('price', $errors) !!}
{!! Form::label('price', 'Price') !!}
{!! Form::text('price', null, ['class' => 'form-control']) !!}
{!! Form::error('price', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('user_id', $errors) !!}
{!! Form::hidden('user_id', Auth::user()->id, ['class' => 'form-control']) !!}
{!! Form::error('user_id', $errors) !!}
{!! Html::closeFormGroup() !!}
