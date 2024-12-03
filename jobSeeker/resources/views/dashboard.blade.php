<!DOCTYPE html>
<html>
  <x-head :title="'Dashboard'"></x-head>
  <body>
    <x-sidebar></x-sidebar>

    <div class="container">
     <x-navbar></x-navbar>

      <div class="main">
        <div class="content">
          <div class="header">
            <h4>Opportunities matching your skills <span>{{ count($jobs) }}</span></h4>
            <p>Here are jobs that fit your skill set</p>
          </div>
      
          <div class="job-cards">
            @foreach($jobs as $job)
            <div class="card">
              <div class="card-header">
                <div class="job-info">
                  <i class='bx bxs-briefcase'></i>
                  <div>
                    <h5>{{ $job->title }} <span>| {{ $job->created_at->format('Y-m-d') }}</span></h5>

                    <p>{{ $job->location }}</p>
                  </div>
                </div>
                <i class="bx bx-bookmark-plus"></i>
              </div>
              <div class="card-tags">
                <a href="{{ route('job-posts.show', $job) }}">Remote</a>
                <a href="{{ route('job-posts.show', $job) }}">{{ $job->jobType }}</a>
              </div>
              <div class="card-desc"><p>{{ $job->description }}</p></div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>

    <script src="{{ asset('assets/DashboardScript.js') }}"></script>
  </body>
</html>