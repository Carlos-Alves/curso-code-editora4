@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h3>Permissões de {{$role->name}}</h3>
        </div>

        <div class="row">
            {!! Form::open(['route' => ['codeeduuser.roles.permissions.edit', $role->id], 'class' => 'form', 'method' => 'PUT']) !!}

                {!! Html::openFormGroup() !!}
                {!! Button::primary('Salvar')->submit() !!}
                {!! Html::closeFormGroup() !!}
                {!! Form::close() !!}

        </div>
    </div>
    @endsection