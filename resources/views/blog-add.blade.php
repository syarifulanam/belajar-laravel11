<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<style>
    #desc-textarea {
        resize: none;
    }
</style>

<body>
    <div class="container">
        <div class="mt-5">
            <h2 class="mb-5">Add New Blog Data</h2>
            
            @if($errors->any())
                <div class="alert alert-danger col-md-6">
                <ul>
                   @foreach($errors->all() as $error)
                    <li>{{ $error}}</li>
                   @endforeach 
                </ul>
            </div>
            @endif
                        
            <form action="{{ url('blog/create') }}" method="POST">
                @csrf
                <div class="col-md-6">
                    <label for="title" class="form-label">Title :</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title')}}">
                </div>
                <div class="mt-3 col-md-6">
                    <label for="description" class="form-label">Description :</label>
                    <textarea class="form-control" name="description" id="desc-textarea" rows="5">{{ old('description')}}</textarea>
                </div>
                <div class="mt-3 col-md-6">
                    <label class="form-label">Tags :</label>
                    @foreach($tags as $key => $tag)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tags[]" id="tag{{ $key }}" value="{{ $tag->id }}">
                        <label class="form-check-label" for="tag{{ $key }}">
                            {{ $tag->name }}
                        </label>
                    </div>
                    @endforeach
                </div>
                <div class="mt-3 col-md-6">
                    <button class="btn btn-success form-control">Save</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>