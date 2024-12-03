<!DOCTYPE html>
<html>
  <x-head :title="'My Jobs'"></x-head>
  <body>
    <x-sidebar></x-sidebar>

    <div class="container">

      <div class="main">
        <div class="content">
          <div class="header-myJobs">
            <div class="text">
              <h1 class="h1-job-details">Your Job Posts</h1>
            </div>
            <div class="button-create">
              <a href="{{ route('job-posts.create') }}"><button>Create Job Post</button></a>
            </div>
          </div>
      
          <div class="job-cards">
            @foreach($jobPosts as $jobpost)
            <div class="card">
              <div class="card-header">
                <div class="job-info">
                  <div>
                    <h5>{{ $jobpost->company }} </h5>
                    <a href="{{ route('job-posts.showApplicants', $jobpost->id) }}"><h2>{{ $jobpost->title }}</h2></a>
                    <a href="{{ route('job-posts.showApplicants', $jobpost->id) }}"><p style="font-weight: normal"><span>|{{ $jobpost->created_at->format('Y-m-d') }}</span></p></a>
                  </div>
                </div>
              </div>
              <div class="card-tags">
                <a href="{{ route('job-posts.showApplicants', $jobpost->id) }}">{{ $jobpost->location }}  |  {{ $jobpost->jobType }}</a>
              </div>
              <div class="card-desc"><p>{{ $jobpost->description }}</p></div>
            </div>
            @endforeach
          </div>

          <!-- Custom Pagination -->
          <div class="pagination-container">
            @if ($jobPosts->hasPages())
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($jobPosts->onFirstPage())
                        <li class="disabled"><span>&laquo;</span></li>
                    @else
                        <li><a href="{{ $jobPosts->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($jobPosts->getUrlRange(1, $jobPosts->lastPage()) as $page => $url)
                        @if ($page == $jobPosts->currentPage())
                            <li class="active"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($jobPosts->hasMorePages())
                        <li><a href="{{ $jobPosts->nextPageUrl() }}" rel="next">&raquo;</a></li>
                    @else
                        <li class="disabled"><span>&raquo;</span></li>
                    @endif
                </ul>
            @endif
          </div>
        </div>
      </div>
    </div>

    <script src="{{asset('assets/DashboardScript.js')}}"></script>

    <style>
      /* Extra Small Pagination Style */
      .pagination-container {
        margin-top: 15px;
        margin-bottom: 15px;
        display: flex;
        justify-content: center;
      }

      .pagination {
        display: flex;
        gap: 3px;
        align-items: center;
      }

      .pagination li {
        display: inline-block;
        font-size: 10px;
        line-height: 1;
      }

      .pagination li a,
      .pagination li span {
        padding: 3px 6px;
        border: 1px solid #ddd;
        color: #666;
        text-decoration: none;
        border-radius: 2px;
        min-width: 20px;
        height: 20px;
        text-align: center;
        display: inline-flex;
        align-items: center;
        justify-content: center;
      }

      .pagination li.active span {
        background: #007bff;
        color: white;
        border-color: #007bff;
      }

      .pagination li.disabled span {
        color: #ccc;
        background: #f8f8f8;
      }

      .pagination li a:hover {
        background: #f5f5f5;
      }
    </style>
  </body>
</html>