@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h3>Editar papel de usuário</h3>



            {!! Form::model($role, [
                'route' => ['codeeduuser.roles.update', 'role' => $role->id],
                'class' => 'form', 'method' => 'PUT']) !!}

            @include('codeeduuser::roles._form')

            {!! Html::openFormGroup() !!}
            {!! Form::submit('Salvar papel de usuário', ['class' => 'btn btn-primary']) !!}
            {!! Html::closeFormGroup() !!}


        {!! Form::close() !!}

        </div>
    </div>
    @endsection