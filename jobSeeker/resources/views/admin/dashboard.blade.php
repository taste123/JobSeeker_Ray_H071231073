<!DOCTYPE html>
<html lang="en">
  <x-head :title="'Admin Dashboard'"></x-head>
  <body>
    <x-sidebar></x-sidebar>
    <div class="container">
      <div class="main">
        <div class="content">
          <h1 class="h1-profile-details">Admin Dashboard</h1>
          <div class="stats">
            <p>Total Users: {{ $totalUsers }}</p>
            <p>Total Job Posts: {{ $totalJobPosts }}</p>
            <p>Total Applications: {{ $totalApplications }}</p>
          </div>

          <div class="card-container">
            <div class="card">
              <h2>Add User</h2>
              <p>Add new users to the system.</p>
              <a href="{{ route('admin.addUserForm') }}" class="btn btn-primary">Go to Add User</a>
            </div>
            <div class="card">
              <h2>Manage Users</h2>
              <p>View and manage existing users.</p>
              <a href="{{ route('admin.manageUsers') }}" class="btn btn-primary">Go to Manage Users</a>
            </div>
            <div class="card">
              <h2>Manage Job Posts</h2>
              <p>View and manage job posts.</p>
              <a href="{{ route('admin.manageJobs') }}" class="btn btn-primary">Go to Manage Jobs</a>
            </div>
          </div>
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

  .stats {
    margin-bottom: 20px;
  }

  .card-container {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
  }

  .card {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 30%;
    text-align: center;
  }

  .card h2 {
    margin-bottom: 10px;
  }

  .card p {
    margin-bottom: 20px;
  }

  .btn-primary {
    background-color: #2e4cad;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
  }

  .btn-primary:hover {
    background-color: #1d3a8a;
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
</style>