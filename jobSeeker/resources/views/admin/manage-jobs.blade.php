<!DOCTYPE html>
<html lang="en">
  <x-head :title="'Manage Job Posts'"></x-head>
  <body>
    <x-sidebar></x-sidebar>
    <div class="container">
      <div class="main">
        <div class="content">
          <h1 class="h1-profile-details">Manage Job Posts</h1>
          <table class="table">
            <thead>
              <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Job Type</th>
                <th>Location</th>
                <th>Salary Range</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($jobs as $job)
                <tr>
                  <td>{{ $job->title }}</td>
                  <td>{{ $job->description }}</td>
                  <td>{{ $job->jobType }}</td>
                  <td>{{ $job->location }}</td>
                  <td>${{ number_format($job->salary_min, 2) }} - ${{ number_format($job->salary_max, 2) }}</td>
                  <td>
                    <form action="{{ route('admin.deleteJob', $job->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <script src="{{ asset('assets/DashboardScript.js') }}"></script>
  </body>
</html>

<style>
  .container {
    flex: 7;
    padding: 20px 40px 20px 24px;
    background: linear-gradient(#e2e2e2, #c9d6ff);
    background-attachment: fixed;
  }

  .main {
    display: flex;
  }

  .content {
    flex: 9;
  }

  .h1-profile-details {
    margin-top: 20px;
    font-size: 24px;
    font-weight: bold;
  }

  .table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
  }

  .table th, .table td {
    padding: 12px 15px;
    border: 1px solid #ddd;
    text-align: left;
  }

  .table th {
    background-color: #f2f2f2;
    font-weight: bold;
  }

  .table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
  }

  .table tbody tr:hover {
    background-color: #f1f1f1;
  }

  .btn-danger {
    background-color: #dc3545;
    color: #fff;
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .btn-danger:hover {
    background-color: #c82333;
  }
</style>