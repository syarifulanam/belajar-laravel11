<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reset Password Page</title>
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
  </style>
</head>
<body>
    
  <div class="container d-flex justify-content-center align-items-center login-container">
    <div class="p-4 shadow card" style="width: 100%; max-width: 400px;">
      <h3 class="mb-4 text-center">Reset Password</h3>

      {{-- Show success message --}}
      @if(session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
      @endif

      {{-- Show error messages --}}
      @if($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
              @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div>
      @endif

      <form action="/reset-password" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required placeholder="Enter your email">
        </div>
        
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
        </div>
        
        <div class="mb-3">
            <label for="repassword" class="form-label">Retype Password</label>
            <input type="password" class="form-control" id="repassword" name="password_confirmation" required placeholder="Re-enter your password">
        </div>
        
        <div class="mb-3">
            <input type="hidden" class="form-control" id="token" name="token" value="{{ $token }}" required>
        </div>
        
        <div class="gap-2 d-grid">
          <button type="submit" class="btn btn-primary w-100">Send</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>