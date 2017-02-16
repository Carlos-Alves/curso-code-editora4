@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h3>Listagem de papel de usuários</h3>

            {!! Button::primary('Novo papel de usuário')->asLinkTo(route('codeeduuser.roles.create')) !!}

        </div>

        @include('layouts._campo-busca', ['nomeDoCampo' => 'Pesquisa por nome'])

        <div class="row">

            {!!
                Table::withContents($roles->items())->striped()
                 ->callback('Ações', function ($filed, $role){
                    $linkEdit = route('codeeduuser.roles.edit', ['role' => $role->id]);
                    $linkDestroy = route('codeeduuser.roles.destroy', ['role' => $role->id]);
                    $linkEditPermission = route('codeeduuser.roles.permissions.edit', ['role' => $role->id]);
                    $deleteForm = "delete-form-{$role->id}";
                    $form = Form::open(['route' =>
                            ['codeeduuser.roles.destroy', 'role' => $role->id],
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
                                "<li>|</li>".
                                 "<li>".Button::link('Permissões')->asLinkTo($linkEditPermission)."</li>".
                            "</ul>".
                            $form;
                 })
            !!}


            {{ $roles->links() }}

        </div>
    </div>
    @endsection