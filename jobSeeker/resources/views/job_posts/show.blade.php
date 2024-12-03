<!DOCTYPE html>
<html>
    <x-head :title="'Job Details'"></x-head>
  <body>
    <x-sidebar></x-sidebar>
    <div class="container">
        <h1 class="h1-job-details">Job details</h1>
        <div class="job-details">
            <div class="job-desc">
                <h1>{{ $jobPost->title }}</h1>
                <p>{{ $jobPost->description }}</p>
            </div>
            <div class="job-meta">
                <div class="meta-table">
                    <table>
                        <tr>
                            <th>Job Type:</th>
                            <td>{{ $jobPost->jobType }}</td>
                        </tr>
                        <tr>
                            <th>Location:</th>
                            <td>{{ $jobPost->location }}</td>
                        </tr>
                        <tr>
                            <th>Salary Range:</th>
                            <td>${{ number_format($jobPost->salary_min, 2) }} - ${{ number_format($jobPost->salary_max, 2) }}</td>
                        </tr>
                    </table>
                </div>
                @auth
                <div class="apply-form">
                    @if (Auth::user()->role === 'employer')
                        <p>Sorry, you can't apply for jobs with this account.</p>
                    @else
                        @php
                            $application = Auth::user()->applications()->where('job_post_id', $jobPost->id)->first();
                        @endphp
                        @if ($application && in_array($application->status, ['on process', 'accepted']))
                            <p>You have already applied for this job. Status: {{ $application->status }}</p>
                        @else
                            <form action="{{ route('job-posts.apply', $jobPost) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="cv">Upload CV</label>
                                    <div class="file-drop-area">
                                        <span class="fake-btn">Choose file</span>
                                        <span class="file-msg">or drag and drop file here</span>
                                        <input class="file-input" type="file" name="cv" id="cv" required>
                                    </div>
                                </div>
                                <button type="submit" class="apply">Apply</button>
                            </form>
                        @endif
                    @endif
                </div>
                @else
                <div class="apply-form">
                    <div class="form-group">
                        <a href="/login" class="login-to-apply"><h4>Login or Register to apply for jobs</h4></a>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/DashboardScript.js') }}"></script>
    <script>
        document.querySelectorAll('.file-input').forEach(inputElement => {
            const dropZoneElement = inputElement.closest('.file-drop-area');

            dropZoneElement.addEventListener('click', () => {
                inputElement.click();
            });

            inputElement.addEventListener('change', () => {
                if (inputElement.files.length) {
                    dropZoneElement.querySelector('.file-msg').textContent = inputElement.files[0].name;
                }
            });

            dropZoneElement.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropZoneElement.classList.add('is-dragover');
            });

            ['dragleave', 'dragend'].forEach(type => {
                dropZoneElement.addEventListener(type, () => {
                    dropZoneElement.classList.remove('is-dragover');
                });
            });

            dropZoneElement.addEventListener('drop', (e) => {
                e.preventDefault();

                if (e.dataTransfer.files.length) {
                    inputElement.files = e.dataTransfer.files;
                    dropZoneElement.querySelector('.file-msg').textContent = e.dataTransfer.files[0].name;
                }

                dropZoneElement.classList.remove('is-dragover');
            });
        });
    </script>
  </body>
</html>