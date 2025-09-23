<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All User Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        header {
            border-bottom: 3px solid #ff9800;
        }
        h1 {
           
            padding-left: 10px;
            font-weight: bold;
            color: #343a40;
           
        }
        table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        th {
            background: #343a40;
            color: white;
        }
        tr:hover {
            background: #f1f1f1;
        }
        .pagination-controls {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<header class="bg-dark text-white py-3 shadow-sm">
  <div class="container d-flex justify-content-between align-items-center">
    <a class="btn btn-warning btn-sm fw-bold" href="/coach">🏋 Assign User</a>
    <a href="{{route('logout')}}" class="btn btn-danger btn-sm fw-bold">Logout</a>
  </div>
</header>

<div class="container mt-4">
    <h1 class="mb-4">All User Details</h1>

    {{-- Flash Messages --}}
    @if(session('error'))
        <div class="alert alert-danger text-center fw-bold">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success text-center fw-bold">
            {{ session('success') }}
        </div>
    @endif

    {{-- User Table --}}
    <div class="table-responsive">
      <table class="table table-hover text-center align-middle">
        <thead>
          <tr>
            <th>Sl No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Height</th>
            <th>Weight</th>
            <th>Gender</th>
            <th>Role</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $rec)
          <tr>
            <td>{{ ($users->currentPage()-1) * $users->perPage() + $loop->iteration }}</td>
            <td class="fw-semibold">{{ $rec->name }}</td>
            <td>{{ $rec->email }}</td>
            <td>{{ $rec->height }}</td>
            <td>{{ $rec->weight }}</td>
            <td><span class="badge bg-info text-dark">{{ ucfirst($rec->gender) }}</span></td>
            <td>
              <form action="{{ url('update-role/'.$rec->id) }}" method="POST">
                @csrf
                @method('PUT')
                <select name="role" class="form-select form-select-sm" onchange="this.form.submit()">
                  <option value="User" {{ $rec->role == 'User' ? 'selected' : '' }}>User</option>
                  <option value="Coach" {{ $rec->role == 'Coach' ? 'selected' : '' }}>Coach</option>
                </select>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    {{-- Pagination (Simple) --}}
    <div class="d-flex justify-content-between align-items-center pagination-controls">
        @if ($users->onFirstPage())
            <span class="btn btn-outline-secondary btn-sm disabled">⬅ Previous</span>
        @else
            <a href="{{ $users->previousPageUrl() }}" class="btn btn-outline-primary btn-sm">⬅ Previous</a>
        @endif

        <span class="fw-bold">Page {{ $users->currentPage() }} of {{ $users->lastPage() }}</span>

        @if ($users->hasMorePages())
            <a href="{{ $users->nextPageUrl() }}" class="btn btn-outline-primary btn-sm">Next ➡</a>
        @else
            <span class="btn btn-outline-secondary btn-sm disabled">Next ➡</span>
        @endif
    </div>
</div>

</body>
</html>
