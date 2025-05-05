<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="mt-5">
            <h1 class="text-center">Users List</h1>
            
        <div class="mt-5 table-responsive">
        
            <table class="table table-striped table-hover">
                <thead>
                    <th>#</th> 
                    <th>Name</th>
                    <th>Email</th>
                    <th>Photo</th>
                    <th>Phone</th>
                </thead>
                <tbody class="table-group-divider">
                    @if($users->count() == 0)
                        <tr>
                            <td colspan="3" class="text-center">NO DATA FOUND with <strong>{{ $title }}</strong> keyword</td>
                        </tr>
                    @endif
                    
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop ->index + 1}}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->image ? $user->image->name : '-'}}</td>
                        <td>{{ $user->phone ? $user->phone->phone_number : '-'}}</td> 
                        {{-- <td>[[ $user->phone->phone_number ?? '-']]</td> --}}
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
        
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>

</html>