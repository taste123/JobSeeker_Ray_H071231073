<!DOCTYPE html>
<html lang="en">
  <x-head :title="'Manage Users'"></x-head>
  <body>
    <x-sidebar></x-sidebar>
    <div class="container">
      <div class="main">
        <div class="content">
          <h1 class="h1-profile-details">Manage Users</h1>
          <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
                <tr>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->role }}</td>
                  <td>
                    <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST">
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