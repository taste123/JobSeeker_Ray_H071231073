<!DOCTYPE html>
<html>
  <x-head :title="'Profile'"></x-head>
  <body>
    <x-sidebar></x-sidebar>
    <div class="container">
      <div class="main">
        <div class="content">
          <h1 class="h1-profile-details" style="margin-bottom: 20px">Profile</h1>
          @if (session('success'))
            <div class="alert alert-success" style="margin-bottom: 10px">
              {{ session('success') }}
            </div>
          @endif
          <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="job-details">

              <div class="job-desc">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
  
  
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea name="description" id="description" class="form-control">{{ $user->description }}</textarea>
                </div>
               </div>
              </div>
  
  
              <div class="job-meta">
                <div class="meta-table">
                  <h5>Skills</h5>
                  <div id="skills-container">
                    @foreach($user->skills ?? [] as $skill)
                      <div class="skill-input">
                        <input type="text" name="skills[]" class="form-control" value="{{ $skill }}">
                        <button type="button" class="btn btn-danger remove-skill">Remove</button>
                      </div>
                    @endforeach
                  </div>
                  <button type="button" id="add-skill" class="btn btn-secondary">Add Skill</button>
                </div>
  
                <div class="apply-form">
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <small>Leave blank to keep current password</small>
                  </div>
                  <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>



          </form>
        </div>
      </div>
    </div>
    <script src="{{ asset('assets/DashboardScript.js') }}"></script>
    <script>
      document.getElementById('add-skill').addEventListener('click', function() {
        var container = document.getElementById('skills-container');
        var inputGroup = document.createElement('div');
        inputGroup.className = 'skill-input';
        inputGroup.innerHTML = `
          <input type="text" name="skills[]" class="form-control">
          <button type="button" class="btn btn-danger remove-skill">Remove</button>
        `;
        container.appendChild(inputGroup);
      });

      document.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-skill')) {
          event.target.parentElement.remove();
        }
      });
    </script>
  </body>
</html>

<style>
  .container {
    flex: 7;
    padding: 20px 40px 20px 24px;
    background: linear-gradient(#e2e2e2, #c9d6ff);
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

  .profile-box, .skills-box, .password-box {
    background: #fff;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .skills-box {
    margin-top: 20px;
  }

  .form-group {
    margin-bottom: 15px;
  }

  .form-group label {
    display: block;
    margin-bottom: 5px;
  }

  .form-group input, .form-group textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  .btn-primary {
    background-color: #2e4cad;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .btn-primary:hover {
    background-color: #1d3a8a;
  }

  .btn-secondary {
    background-color: #6c757d;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .btn-secondary:hover {
    background-color: #5a6268;
  }

  .btn-danger {
    background-color: #dc3545;
    color: #fff;
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-left: 10px;
  }

  .btn-danger:hover {
    background-color: #c82333;
  }

  .skill-input {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
  }

  .skill-input input {
    flex: 1;
  }
</style>