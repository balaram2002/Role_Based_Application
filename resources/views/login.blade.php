<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
body {
  background: linear-gradient(135deg, #4facfe, #00f2fe);
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

header {
    width: 100%;
    position: fixed;
    top: 0;
    left: 0;
    background: linear-gradient(135deg, #4facfe, #00f2fe);
    z-index: 1000;
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
    padding: 10px 0;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}
header img {
    height: 50px;
    width: auto;
}


.login-card {
  background: #fff;
  border-radius: 15px;
  box-shadow: 0px 4px 20px rgba(0,0,0,0.1);
  padding: 40px;
  width: 100%;
  max-width: 400px;
}
.login-card h1 {
  font-weight: bold;
  color: #333;
  margin-bottom: 20px;
text-align:center;
}
.form-control {
  border-radius: 10px;
  padding-left: 40px;
}
.input-icon {
  position: absolute;
  left: 12px;
  top: 50%;
  transform: translateY(-50%);
  color: #888;
}
.btn-custom {
  border-radius: 10px;
  font-weight: bold;
  padding: 10px;
}
.btn-login {
  background: #007bff;
  color: #fff;
}
.btn-login:hover {
  background: #0056b3;
}
.btn-register {
  background: #28a745;
  color: #fff;
}
.btn-register:hover {
  background: #1e7e34;
}

.alert {
  border-radius: 10px;
  margin-bottom: 20px;
}
</style>

</head>
<body>
<header class="text-white shadow-sm">
  <div class="container d-flex justify-content-between align-items-center">
      <img src="{{ asset('/Images/company.png') }}" alt="Company Logo">
  </div>
</header>

@if(session('error'))
  <div class="alert alert-danger text-center w-50 mx-auto mt-5">
    {{ session('error') }}
  </div>
@endif

@if(session('success'))
  <div class="alert alert-success text-center w-50 mx-auto mt-5">
    {{ session('success') }}
  </div>
@endif

<div class="login-card mt-5">
  <h1>Welcome</h1>

  <form action="/login" method="post">
      @csrf
      <div class="mb-3 position-relative">
          <i class="fa fa-envelope input-icon"></i>
          <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
      </div>
      <div class="mb-3 position-relative">
          <i class="fa fa-lock input-icon"></i>
          <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
      </div>
      <div class="d-grid gap-2 mt-4">
          <button type="submit" class="btn btn-custom btn-login">Log In</button>
          <a href="/register" class="btn btn-custom btn-register">Register</a>
      </div>
  </form>
</div>
</body>
</html>
