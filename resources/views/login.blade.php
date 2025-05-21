<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Page</title>
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
    .form-control {
      border-radius: 6px;
    }
    .btn-primary {
      border-radius: 25px;
    }
    .additional-links {
      text-align: center;
      margin-top: 15px;
    }
  </style>
</head>
<body>

  <div class="container login-container">
    <div class="login-box">
      <h3 class="mb-4 text-center">Login</h3>

      {{-- Error message --}}
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      {{-- Success message --}}
      @if(session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>  
      @endif

      <form action="{{ url('/login') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email" required placeholder="Enter your email">
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Login</button>
        </div>
      </form>

      <div class="additional-links">
        <a href="/register">Don't have an account? Register</a><br>
        <a href="/forgot-password">Forgot password?</a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>