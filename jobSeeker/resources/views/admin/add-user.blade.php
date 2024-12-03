<!DOCTYPE html>
<html lang="en">
  <x-head :title="'Add User'"></x-head>
  <body>
    <x-sidebar></x-sidebar>
    <div class="container">
      <div class="main">
        <div class="content">
          <h1 class="h1-profile-details">Add User</h1>
          <form action="{{ route('admin.addUser') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group">
              <label for="password_confirmation">Confirm Password</label>
              <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password" required>
            </div>
            <div class="form-group">
              <label for="role">Role</label>
              <select name="role" id="role" class="form-control" required>
                <option value="admin">Admin</option>
                <option value="employer">Employer</option>
                <option value="job_seeker">Job Seeker</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Add User</button>
          </form>
        </div>
      </div>
    </div>
    <script src="{{ asset('assets/DashboardScript.js') }}"></script>
  </body>
</html>