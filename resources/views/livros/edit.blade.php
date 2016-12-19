@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h3>Editar Livro</h3>

            {!! Form::model($livro, [
                'route' => ['livros.update', 'livro' => $livro->id],
                'class' => 'form', 'method' => 'PUT']) !!}

            @include('livros._form')

            {!! Html::openFormGroup() !!}
                {!! Button::primary('Salvar categoria')->submit() !!}
            {!! Html::closeFormGroup() !!}

        {!! Form::close() !!}

        </div>
    </div>
    @endsection