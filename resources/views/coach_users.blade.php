<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header class="bg-dark text-white py-3 shadow">
  <div class="container d-flex justify-content-between align-items-center">
    <h1 class="h3 m-0">Users Assigned to Me</h1>
    <nav>
      <a href="/show" class="btn btn-primary btn-sm">Dashboard</a>
      <a href="/logout" class="btn btn-danger btn-sm">Logout</a>
    </nav>
  </div>
</header>
@if(session('error'))
    <div style="color: red; font-weight: bold; margin-top:10px;">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif  

<div class="container mt-5">
    @if($users->isEmpty())
        <div class="alert alert-warning">No users are assigned to you yet.</div>
    @else
        <table class="table table-bordered shadow">
            <thead class="table-dark">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

</body>
</html>
