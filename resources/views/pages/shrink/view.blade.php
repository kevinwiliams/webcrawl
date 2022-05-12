<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Short Links</h1>

    <form method="POST" name="shrinkForm" action="/shortn">
        @csrf <!-- {{ csrf_field() }} -->
    <input type="text" name="url" value=""><br />
    <input type="submit" name="Submit">
    </form>
    @if (Session::has('success'))
                
                    <p style="color: green">{{ Session::get('success') }}</p>
                
    @endif
    <table border="1">
        <thead> 
            <tr>
                <th>URL</th>
                <th>Title</th>
                <th>Shrunk URL</th>
                <th>Tries</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shortLinks as $link)
                <tr>
                    <td>{{$link->url}}</td>
                    <td>{{$link->title}}</td>
                    <td><a href="/get/{{$link->id}}" target="_blank"> {{$link->shrunk_url}}</a></td>
                    <td>{{$link->tries}}</td>
                </tr>    
            @endforeach

        </tbody>

    </table>

</body>
</html>