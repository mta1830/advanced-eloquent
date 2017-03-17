<!DOCTYPE html>
<html>
<head>
    <title>Relaciones</title>
</head>
<body>
@foreach($categories as $category)
    <p>
        {{ $category->name }}
        {{ $category->num_public_books }} de {{ $category->num_books }}
    </p>
    <ul>
        @foreach($category->public_books as $book)
            <li>
                {{ $book->title }} <em>{{ $book->status }}</em>
            </li>
        @endforeach
    </ul>
@endforeach
</body>
</html>