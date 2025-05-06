<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="mt-5">
            <h1 class="text-center">Blog List</h1>
            
        <div class="mt-5 table-responsive">
            <a href="{{ url('blog/add')}}" class="mb-3 btn btn-primary">Add New</a>
            
            @if(Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>              
        @endif
            
        <form method="GET">
            <div class="mb-3 input-group">
                <input type="text" name="title" value="{{ $title }}" class="form-control" placeholder="Search Title" aria-label="Search Title" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
              </div>
        </form>
        
            <table class="table table-striped table-hover">
                <thead>
                    <th>#</th> 
                    <th>Title</th>
                    <th>image</th>
                    <th>Tags</th>
                    <th>Rating</th>
                    <th>Comments</th>
                    <th>Action</th>
                </thead>
                <tbody class="table-group-divider">
                    @if($blogs->count() == 0)
                        <tr>
                            <td colspan="3" class="text-center">NO DATA FOUND with <strong>{{ $title }}</strong> keyword</td>
                        </tr>
                    @endif
                    
                    @foreach ($blogs as $blog)
                    <tr>
                        <td>{{ ($blogs->currentpage()-1) * $blogs->perpage() + $loop->index + 1}}</td>
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->image ? $blog->image->name : '-'}}</td>
                        <td>
                            @foreach( $blog->tags as $tag)
                            <div>{{ $tag->name }}</div>
                            @endforeach
                        </td>
                        <td>
                            @if($blog->ratings->count() < 1)
                                not rated yet
                            @else{{
                                collect($blog->ratings->pluck('rating_value'))->avg() //cara memunculkan rating
                                 }}
                            @endif
                        </td>
                        <td>
                            @foreach($blog->comments as $comment)
                                <div>{{ $comment->comment_text }}</div>
                            @endforeach
                        </td>
                        <td><a href="{{ url('blog/'.$blog->id.'/detail')}}">View</a> | <a href="{{ url('blog/'.$blog->id.'/edit')}}">Edit</a> | <a href="{{ url('blog/'.$blog->id.'/delete')}}">Delete</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        {{ $blogs->links()}}
        
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>

</html>