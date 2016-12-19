@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h3>Novo Livro</h3>


            {{--  @include('errors._errors_form') --}}



            {!! Form::open(['route' => 'livros.store', 'class' => 'form']) !!}

                @include('livros._form')

            {!! Html::openFormGroup() !!}
                {!! Button::primary('Criar livro')->submit() !!}
            {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}

        </div>
    </div>
    @endsection