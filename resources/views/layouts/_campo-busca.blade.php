<br>
<div class="row">
    {!!  Form::model(compact('search'), ['class' => 'form-inline', 'method' => 'GET']) !!}
    {!! Form::label('search', $nomeDoCampo, ['class'=>'control-label']) !!}
    {!! Form::text('search', null, ['class' => 'form-control']) !!}

    {!! Button::primary('Buscar')->submit() !!}
    {!! Form::close() !!}

</div>
<br>