<!DOCTYPE html>
<html>
<head>
    <title>{{ $book->title }}</title>
</head>
<body>
    <h1>{{ $book->title }}</h1>
    <iframe src="{{ asset('storage/books/' . $book->file_name) }}" width="100%" height="600px"></iframe>
</body>
</html>
