<!DOCTYPE html>
<html>
<head>
    <title>Bolo Disponível</title>
</head>
<body>
    <h1>Olá, {{ $data['email'] }}!</h1>
    <p>O bolo que você deseja está disponível:</p>
    <p> <strong>{{ $data['cake_name'] }}</strong></p>
</body>
</html>