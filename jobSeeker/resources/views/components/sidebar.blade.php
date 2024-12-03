<div class="sidebar">
    <a href="#" id="titleSidebar">Job Seeker</a>

    <div class="sideNav">
      <div class="item {{ request()->is('/') ? 'active' : '' }}">
        <i class="bx bx-search-alt"></i>
        <a href="/">Dashboard</a>
      </div>
      @if (request()->is('job-posts/*') && !request()->is('job-posts/create') && !request()->is('job-posts/*/applicants'))
        <div class="item active sidebar-hide">
          <i class='bx bx-info-circle'></i>
          <a href="#">Job Details</a>
        </div>
      @endif
      @if (Auth::check() && Auth::user()->role === 'job_seeker')
        <div class="item {{ request()->is('applied') ? 'active' : '' }}">
          <i class="bx bx-briefcase"></i>
          <a href="/applied">Applied Jobs</a>
        </div>
      @elseif (Auth::check() && Auth::user()->role === 'employer')
        <div class="item {{ request()->is('my-jobs') ? 'active' : '' }}">
          <i class="bx bx-briefcase"></i>
          <a href="/my-jobs">My Job Posts</a>
        </div>
        @if (request()->is('job-posts/*/applicants'))
          <div class="item active sidebar-hide">
            <i class='bx bx-user-voice'></i>
            <a href="#">My Applicant</a>
          </div>
        @endif
        <div class="item {{ request()->is('job-posts/create') ? 'active' : '' }}">
          <i class='bx bxs-plus-circle'></i>
          <a href="{{ route('job-posts.create') }}">Create Job</a>
        </div>
      @elseif (Auth::check() && Auth::user()->role === 'admin')
        <div class="item {{ request()->is('admin') ? 'active' : '' }}">
          <i class="bx bx-cog"></i>
          <a href="/admin">Manage</a>
        </div>
      @endif
    </div>

    @auth
    <div class="sideProfile">
      <div class="info">
        <a href="#">{{ Auth::user()->name }}</a>
        <p>{{ Auth::user()->email }}</p>
      </div>
      <div class="skills">
        <h5>Skills and Expertise</h5>
        <div class="skillTags">
          @if (Auth::check() && Auth::user()->skills)
            @foreach (Auth::user()->skills as $skill)
              <div class="item">
                <p>{{ $skill }}</p>
              </div>
            @endforeach
          @else
            <p>No skills listed.</p>
          @endif
        </div>
      </div>
      <a href="{{ route('profile.edit') }}"><button>View Profile</button></a>
    </div>
    @else
    <div class="sideProfile">
      <div class="info">
        <a href="#">guest</a>
      </div>
      <div class="skills">
        <div class="skillTags">
          @if (Auth::check() && Auth::user()->skills)
          @else
            <p>Login to unlock our features.</p>
          @endif
        </div>
      </div>
      <a href="{{ route('profile.edit') }}"><button>Login/register</button></a>
    </div>
    @endauth
</div>