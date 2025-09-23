<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Show Details</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" 
integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<style>
    body {
        background: linear-gradient(to right, #6a11cb, #2575fc);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Poppins', sans-serif;
        padding: 20px;
    }

    header {
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
        background: linear-gradient(90deg, #6a11cb, #2575fc);
        z-index: 1000;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }

    header img {
        height: 50px;
        width: auto;
    }

    .card {
        border-radius: 20px;
        padding: 40px 30px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        background-color: #ffffffdd;
        backdrop-filter: blur(10px);
        max-width: 450px;
        width: 100%;
        margin-top: 100px;
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    h1 {
        color: #2575fc;
        font-weight: 700;
    }

    h3 {
        color: #6a11cb;
        font-weight: 500;
        margin-bottom: 30px;
    }

    .form-control {
        border-radius: 10px;
        padding: 12px 15px;
        border: 1px solid #ccc;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #2575fc;
        box-shadow: 0 0 8px rgba(37,117,252,0.4);
    }

    .btn-primary {
        background-color: #2575fc;
        border-color: #2575fc;
        border-radius: 10px;
        padding: 10px 25px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #6a11cb;
        border-color: #6a11cb;
    }

    .btn-danger {
        border-radius: 10px;
        padding: 10px 25px;
        transition: all 0.3s ease;
    }

    .gender-group {
        display: flex;
        gap: 30px;
        margin-top: 15px;
    }

    .form-check-label {
        font-weight: 500;
        color: #555;
    }

    .alert {
        max-width: 450px;
        margin: 15px auto;
        border-radius: 10px;
        padding: 12px 20px;
    }

    @media (max-width: 576px) {
        .card {
            padding: 30px 20px;
        }
        .gender-group {
            flex-direction: column;
            gap: 10px;
        }
    }
</style>
</head>
<body>

<header class="text-white py-3 shadow-sm">
  <div class="container d-flex justify-content-between align-items-center">
      <img src="{{ asset('/Images/company.png') }}" alt="Company Logo">
      <nav>
        <a href="login" class="btn btn-outline-light btn-sm">⬅ Back</a>
      </nav>
  </div>
</header>

@if(session('error'))
    <div class="alert alert-danger text-center">
        {{ session('error') }}
    </div>
@endif
@if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <h1 class="text-center mb-2">Welcome {{Auth::user()->name}}</h1>
    <h3 class="text-center">Fill Your Details</h3>
    
    <form action="/show" method="post">
        @csrf
        <div class="mb-3">
            <label for="height" class="form-label">Height</label>
            <input type="text" name="height" id="height" class="form-control" placeholder="Enter your height" required>
        </div>
        
        <div class="mb-3">
            <label for="weight" class="form-label">Weight</label>
            <input type="text" name="weight" id="weight" class="form-control" placeholder="Enter your weight" required>
        </div>

        <div class="gender-group">
            <div class="form-check">
                <input type="radio" id="male" name="gender" value="male" class="form-check-input" required>
                <label for="male" class="form-check-label">Male</label>
            </div>
            <div class="form-check">
                <input type="radio" id="female" name="gender" value="female" class="form-check-input">
                <label for="female" class="form-check-label">Female</label>
            </div>
        </div>

        <div class="text-center mt-4">
            <button class="btn btn-primary me-2">Submit</button>
            <a href="{{ route('logout') }}" class="btn btn-danger me-2">Logout</a>
            @if(Auth::user()->role === 'Coach')
                <a href="{{ route('my.users') }}" class="btn btn-primary">My Users</a>
            @endif
        </div>
    </form>
</div>

</body>
</html>
