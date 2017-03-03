@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h3>Listagem de categorias</h3>
            @can('users-admin/list')
            {!! Button::primary('Nova categoria')->asLinkTo(route('categories.create')) !!}
            @endcan
        </div>

        @include('layouts._campo-busca', ['nomeDoCampo' => 'Pesquisa por nome'])

        <div class="row">

            {!!
                Table::withContents($categories->items())->striped()
                 ->callback('Ações', function ($filed, $category){

                    $linkEdit = route('categories.edit', ['category' => $category->id]);

                    $linkDestroy = route('categories.destroy', ['category' => $category->id]);
                    $deleteForm = "delete-form-{$category->id}";
                    $form = Form::open(['route' =>
                            ['categories.destroy', 'category' => $category->id],
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


            {{ $categories->links() }}

        </div>
    </div>
    @endsection