<!doctype html>
<html>
    <head>
        <title>Many to Many</title>
    </head>
    <body>
        <h1>Relación</h1>
        {!! Form::model($user, ['route' => ['putEdit', $user->id],'method'=>'PUT']) !!}
            <div>
                <p>
                    <strong>Usuario (Autor):</strong>
                    {{ $user->name }}
                </p>
            </div>
            <div>
                {!! Form::label('books','Libros:') !!}
                {!! Form::select('books_id[]',$books,null,['multiple']) !!}
            </div>
            {!! Form::submit('Actualizar') !!}
        {!! Form::close() !!}
    </body>
</html>