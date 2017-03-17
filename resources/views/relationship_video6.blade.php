<!DOCTYPE html>
<html>
<head>
    <title>Relaciones</title>
</head>
<body>
@foreach($categories as $category)
    <p>
        {{ $category->name }}
    </p>
@endforeach
</body>
</html>