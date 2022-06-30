<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Send Mail</title>
</head>
<body>
    <h1>Send Mail</h1>
    {{-- <form action="{{ route('send_mail') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Name">
        <input type="text" name="email" placeholder="Email">
        <input type="text" name="subject" placeholder="Subject">
        <textarea name="content" id="" cols="30" rows="10" placeholder="Content"></textarea>
        <button type="submit">Send</button>
    </form> --}}
    <h1>Email</h1>
    <h2> Mail form {{ $name }}</h2>
    {{-- <p>{{ $content }}</p> --}}
</body>
</html>