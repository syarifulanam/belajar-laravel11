<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
   body {
        background-color: #f4f4f4;
        height: 100%;
        margin: 0;
    }
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .login-box {
        width: 100%;
        max-width: 400px;
        padding: 30px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }
    .login-box h3 {
        text-align: center;
        margin-bottom: 30px;
    }
    .form-control {
        border-radius: 6px; /* instead of 25% */
    }
    .btn-primary {
        border-radius: 25px;
    }
    .forgot-password {
        text-align: center;
        margin-top: 15px;
    }
  </style>
</head>
<body>
    
  <div class="container d-flex justify-content-center align-items-center login-container">
    <div class="p-4 shadow card" style="width: 100%; max-width: 400px;">
      <h3 class="mb-4 text-center">Register</h3>
      <form action="register" method="POST">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name"  name="name" required placeholder="Enter your name">
        </div>
        
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email"  name="email" required placeholder="Enter your email">
        </div>
        
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
        </div>
        
        <div class="gap-2 d-grid">
        <button type="submit" class="btn btn-primary w-100">Register</button>
        </div>
      </form>

      <div class="mt-3 text-center">
        <a href="/login">have account? login!</a>
      </div>
    </div>
    
    @if($errors->any())
        <div class="mt-3 alert alert-danger col-md-6" style="max-width: 400px">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>