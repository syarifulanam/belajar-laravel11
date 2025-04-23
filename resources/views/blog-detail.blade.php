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
                <div class="flex d-flex-column align-items-end">
                    <div>{{ $blog->created_at}}</div>
                    <div>by admin</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>