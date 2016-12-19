@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h3>Listagem de Livros</h3>

            <a href="{{ route('livros.create') }}" class="btn btn-primary">Novo Livro</a>
        </div>

        <div class="row">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Subtitle</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Author</th>
                    <th>Ação</th>
                </tr>
                </thead>

                <tbody>

                @foreach($livros as $livro)
                    <tr>
                        <td>{{ $livro->id }}</td>
                        <td>{{ $livro->title }}</td>
                        <td>{{ $livro->subtitle }}</td>
                        <td> {{ $livro->category ? $livro->category->name:'Não definida' }}</td>
                        <td> {{ $livro->price }}</td>
                        <td> {{ $livro->author ? $livro->author->name:'erro na busca' }}</td>

                    <td>
                        <ul>

                            @if (Auth::user()->can('update-livro', $livro))
                                    <li> <a href="{{ route('livros.edit', ['livro' => $livro->id]) }}">Editar</a></li>

                                    <li><?php $deleteForm = "delete-form-{$loop->index}"; ?>
                                        <a href="{{ route('livros.destroy', ['livro' => $livro->id]) }}"
                                           onclick="event.preventDefault();document.getElementById('{{ $deleteForm }}').submit();">Excluir</a></li>
                                    {!! Form::open(['route' => ['livros.destroy', 'livro' => $livro->id], 'method' => 'DELETE', 'id' => $deleteForm,'style' => 'display:none']) !!}
                                    {!! Form::close() !!}
                                    </li>
                                @else
                                   {{ 'Não autorizado' }}
                                @endif

                        </ul>

                     </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $livros->links() }}

        </div>
    </div>
    @endsection