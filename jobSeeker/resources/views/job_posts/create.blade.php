<!DOCTYPE html>
<html>
  <x-head :title="'Create Jobs'"></x-head>
  <body>
    <x-sidebar></x-sidebar>

    <div class="container">
        <div class="main">
            <div class="content">
                <h1 class="h1-job-details">Create Job Post</h1>
                <form action="{{ route('job-posts.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" name="location" id="location" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="jobType">Job Type</label>
                        <select name="jobType" id="jobType" class="form-control" required>
                            <option value="full-time">Full-time</option>
                            <option value="part-time">Part-time</option>
                            <option value="freelance">Freelance</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact</label>
                        <input type="text" name="contact" id="contact" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="salary_min">Salary Range Min</label>
                        <input type="number" name="salary_min" id="salary_min" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="salary_max">Salary Range Max</label>
                        <input type="number" name="salary_max" id="salary_max" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>

    <script src="{{asset('assets/DashboardScript.js')}}"></script>
  </body>
</html>