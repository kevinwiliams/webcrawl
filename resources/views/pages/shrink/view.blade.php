<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    <h1>Short Links</h1>

    <form method="POST" name="shrinkForm" action="/shortn">
        @csrf <!-- {{ csrf_field() }} -->
    <input type="text" name="url" value="" class="form-control">
    <input type="submit" name="submit" class="" value="Shrink URL">
    </form>
    @if (Session::has('success'))
                
                    <p style="color: green">{{ Session::get('success') }}</p>
                
    @endif
    <table class="table">
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
                    <td><a href="/{{$link->shrunk_url}}" target="_blank"> {{$domain}}{{$link->shrunk_url}}</a></td>
                    <td>{{$link->tries}}</td>
                </tr>    
            @endforeach

        </tbody>

    </table>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>