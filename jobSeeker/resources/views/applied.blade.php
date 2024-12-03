<!DOCTYPE html>
<html>
  <x-head :title="'Applied Jobs'"></x-head>
  <body>
    <x-sidebar></x-sidebar>

    <div class="container">
        
        <div class="main">
            <div class="content">
              <div class="header">
                <h1 class="h1-job-details">Jobs Applied</h1>
              </div>

              @if($appliedJobs->isEmpty())
                <p>You have not applied for any jobs yet.</p>
            @else
          
              <div class="job-cards">
                @foreach($appliedJobs as $job)
                <div class="card">
                  <div class="card-header">
                    <div class="job-info">
                      <div>
                        <a href="#"><h2>{{ $job->title }}</h2></a>
                        <a href="#"><p style="font-weight: normal">Applied on<span> : {{  $job->pivot->created_at->format('d M Y') }}</span></p></a>
                      </div>
                    </div>
                  </div>
                  <div class="card-tags">
                    <a href="{{ route('job-posts.showApplicants', $job->id) }}">Status  |  <span style="color: 
                      @if($job->pivot->status == 'rejected') #b50a0a 
                      @elseif($job->pivot->status == 'accepted') green 
                      @elseif($job->pivot->status == 'on process') #e49b14 
                      @endif">{{ $job->pivot->status }}</span></a>
                  </div>
                </div>
                @endforeach
              </div>
            @endif
          </div>
        </div>
    </div>
    <script src="{{asset('assets/DashboardScript.js')}}"></script>
  </body>
</html>