<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="mt-5">
            <h2 class="text-center">{{ $blog->title}}</h2>
            <div class="body-blog">
                <p>
                    {{ $blog->description}}
                </p>
                    
                <div>
                    tags : @if($blog->tags->count() < 1) - @endif
                    @foreach($blog->tags as $tag)
                        <span class="p-2 text-white rounded bg-secondary me-1">{{ $tag->name}}</span>
                    @endforeach
                </div>
                <div class="flex d-flex-column align-items-end">
                    <div>{{ $blog->created_at}}</div>
                    <div>by admin</div>
                </div>
            </div>
        </div>
        
        <div class="mt-5">
            @if($errors->any())
                <div class="alert alert-danger col-md-6 form-control">
                    <ul>
                       @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                       @endforeach 
                    </ul>
                </div>
            @endif
            
            @if(Session::has('message'))
        <p class="alert alert-success">{{ Session::get('message') }}</p>              
    @endif
    
        <h5>Comments :</h5>
        <form action="{{ url('comment/' . $blog->id) }}" method="POST">
            @csrf         
            <textarea class="form-control" name="comment_text" style="resize:none" rows="5"></textarea>
            <button class="mt-3 btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
    
    <hr class="mt-5">
    
    <div class="mt-5">
        {{ ($blog->comments->count() == 0 ? 'no comments yet' : '')}}
        
        @foreach($blog->comments as $comment)
            <div class="p-3 mb-3" style="background-color:rgb(187, 187, 187)"> {{ $comment->comment_text}} </div>
        @endforeach
    </div>
    </div>
</body>
</html>