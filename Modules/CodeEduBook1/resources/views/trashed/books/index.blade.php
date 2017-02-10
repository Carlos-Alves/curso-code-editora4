@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">
            <h3>Lixeira de Livros</h3>
        </div>

        @include('layouts._campo-busca', ['nomeDoCampo' => 'Pesquisa por título ou nome do autor/categoria'])

        <div class="row">
            @if($books->count() > 0)
            {!!

                Table::withContents($books->items())
                  ->callback('Ações', function ($field, $book){
                   $linkView = route('trashed.books.show', ['book' => $book->id]);
                   $linkDestroy = route('books.destroy', ['book' => $book->id]);
                   $restoreForm = "restore-form-{$book->id}";
                   $form = Form::open(['route' =>
                           ['trashed.books.update', 'book' => $book->id],
                           'method' => 'PUT', 'id' => $restoreForm,'style' => 'display:none']).
                           Form::hidden('redirect_to', URL::previous()).
                           Form::close();

                   $anchorRestore = Button::link('Restaurar')
                                       ->asLinkTo($linkDestroy)->addAttributes([
                                           'onclick' => "event.preventDefault();document.getElementById(\"{$restoreForm}\").submit();"
                                       ]);
                   return "<ul class=\"list-inline\">".
                               "<li>".Button::link('Detalhes')->asLinkTo($linkView)."</li>".
                               "<li>|</li>".
                               "<li>".$anchorRestore."</li>".
                           "</ul>".
                           $form;
                })

            !!}

            @else
                <br>
                <div class="weli well-lg text-center">
                    <strong>Lixeira vazia</strong>
                </div>

            @endif

            {{ $books->links() }}

        </div>
    </div>
    @endsection