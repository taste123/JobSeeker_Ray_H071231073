<!DOCTYPE html>
<html>
  <x-head :title="'Job Information'"></x-head>
  <body>
    <x-sidebar></x-sidebar>

    <div class="container">
      <h1>{{ $jobPost->title }}</h1>
        <p>{{ $jobPost->description }}</p>
        <p>Location: {{ $jobPost->location }}</p>
        <p>Job Type: {{ $jobPost->jobType }}</p>
        <p>Contact: {{ $jobPost->contact }}</p>
        <p>Salary Range: {{ $jobPost->salary_min }} - {{ $jobPost->salary_max }}</p>

        @auth
            <form action="{{ route('job-posts.apply', $jobPost) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="cv">Upload CV</label>
                    <input type="file" name="cv" id="cv" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Apply</button>
            </form>
        @endauth
    </div>

    <script src="{{asset('assets/DashboardScript.js')}}"></script>
  </body>
</html>