<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coach Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
      body {
          background-color: #f8f9fa;
      }
      header {
          background: linear-gradient(90deg, #343a40, #212529);
      }
      .table thead {
          background-color: #343a40;
          color: #fff;
      }
      .table tbody tr:hover {
          background-color: #f1f1f1;
          transition: 0.3s;
      }
      .card {
          border-radius: 12px;
          box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      }
      select {
          border-radius: 6px;
          padding: 4px 8px;
      }
  </style>
</head>
<body>


<header class="text-white py-3 shadow">
  <div class="container d-flex justify-content-between align-items-center">
      <img src="{{ asset('/Images/company.png') }}" 
           alt="Company Logo" 
           style="height:40px; width:auto;">

    <nav>
      <a href="/alluserdetails" class="btn btn-outline-light btn-sm">⬅ Back</a>
    </nav>
  </div>
</header>

<div class="container my-5">

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

  <!-- Table Card -->
  <div class="card p-4">
    <h2 class="h5 mb-3">Coach & Assigned Users</h2>
    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead>
          <tr>
            <th>Sl. No.</th>
            <th>Coach Name</th>
            <th>Email</th>
            <th>Assign User</th>
            <th>Assigned Users</th>
          </tr>
        </thead>
        <tbody>
          @foreach($coaches as $index => $coach)
            <tr>
              <td>{{ ($coaches->currentPage() - 1) * $coaches->perPage() + $index + 1 }}</td>
              <td class="fw-bold">{{ $coach->name }}</td>
              <td>{{ $coach->email }}</td>
              <td>
                <form action="{{ url('assign-user-to-coach/'.$coach->id) }}" method="POST">
                    @csrf
                    <select name="user_id" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">-- Select User --</option>
                        @foreach($allUsers->where('role','User') as $user)
                            <option value="{{ $user->id }}">{{ $user->email }}</option>
                        @endforeach
                    </select>
                </form>
              </td>
              <td>
                <ul class="mb-0">
                  @forelse($coach->assignedUsers as $user)
                      <li>{{ $user->email }}</li>
                  @empty
                      <li class="text-muted">No users assigned</li>
                  @endforelse
                </ul>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-3">
      {{ $coaches->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
