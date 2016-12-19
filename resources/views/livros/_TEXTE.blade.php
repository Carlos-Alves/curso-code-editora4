{!!  Form::hidden('redirect_to', URL::previous()) !!}
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

{!! Html::openFormGroup('papel', $errors) !!}
{!! Form::label('papel', 'Author: ') !!}
{!! Form::label('papel', Auth::user()->name) !!}
{!! Form::error('papel', $errors) !!}
{!! Html::closeFormGroup() !!}


//funcionou
{!! Html::openFormGroup('category', $errors) !!}
{!! Form::label('category', 'Category') !!}
{!! Form::select('category_id',$categories,null, ['class' => 'form-control']) !!}
{!! Form::error('category', $errors) !!}
{!! Html::closeFormGroup() !!}

//RETIRADO PARA TESTES
{!! Html::openFormGroup('category', $errors) !!}
{!! Form::label('category', 'Category') !!}
{!! Form::select('category_id',$categories,null, ['class' => 'form-control']) !!}
{!! Form::error('category', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('user', $errors) !!}
{!! Form::label('user', 'Author') !!}
{!! Form::select('user_id', $users,old('user_id'), ['class' => 'form-control']) !!}
{!! Form::error('user', $errors) !!}
{!! Html::closeFormGroup() !!}

