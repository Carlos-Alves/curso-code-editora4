@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h3>Listagem de Livros</h3>

            {!! Button::primary('Novo Livro')->asLinkTo(route('livros.create')) !!}

        </div>

        <div class="row">

            {!!
               Table::withContents($livros)->striped()
                ->callback('Ações', function ($field, $livro){
                   $linkEdit = route('livros.edit', ['livro' => $livro->id]);
                   $linkDestroy = route('livros.destroy', ['livro' => $livro->id]);
                   $deleteForm = "delete-form-{$livro->id}";
                   $form = Form::open(['route' =>
                           ['livros.destroy', 'livro' => $livro->id],
                           'method' => 'DELETE', 'id' => $deleteForm,'style' => 'display:none']).
                           Form::close();

                   $anchorDestroy = Button::link('Excluir')
                                       ->asLinkTo($linkDestroy)->addAttributes([
                                           'onclick' => "event.preventDefault();document.getElementById(\"{$deleteForm}\").submit();"
                                       ]);
                   return "<ul class=\"list-inline\">".
                               "<li>".Button::link('Editar')->asLinkTo($linkEdit)."</li>".
                               "<li>|</li>".
                               "<li>".$anchorDestroy."</li>".
                           "</ul>".
                           $form;
                })
           !!}

            {{ $livros->links() }}

        </div>
    </div>
    @endsection