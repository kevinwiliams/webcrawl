<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST" name="shrinkForm" action="/shortn">
        @csrf <!-- {{ csrf_field() }} -->
    <input type="text" name="url" value=""><br />
    <input type="submit" name="Submit">
    </form>
</body>
</html>