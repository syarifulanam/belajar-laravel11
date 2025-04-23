<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="mt-5">
            <h2 class="mt-5">Edit Blog : {{ $blog->title}}</h2>

            @if($errors->any())
            <div class="alert alert-danger col md-6">
                <ul>
                   @foreach($errors->all() as $error)
                    <li>{{ $error}}</li>
                   @endforeach 
                </ul>
            </div>
            @endif

            <form action="{{ url('blog/'.$blog->id.'/update')}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="col-md-6">
                    <label for="title" class="form-label">Title :</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $blog->title}}">
                </div>
                <div class="mt-3 col-md-6">
                    <label for="description" class="form-label">Description :</label>
                    <textarea class="form-control" name="description" id="desc-textarea" rows="5">
                        {{ $blog->description}}
                    </textarea>
                </div>
                <div class="mt-3 col-md-6">
                    <button class="btn btn-success form-control">Save</button>
                </div>
            </form>
            
        </div>
    </div>
</body>
</html>