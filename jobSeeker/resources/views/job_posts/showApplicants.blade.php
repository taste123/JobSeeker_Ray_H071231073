<!DOCTYPE html>
<html>
  <x-head :title="'My Applicants'"></x-head>
  <body>
    <x-sidebar></x-sidebar>

    <div class="container mt-5">
        <div class="main">
            <div class="content">
                <h1 class="h1-job-details">Job Applicants for {{ $jobPost->title }}</h1>
                <p>{{ $jobPost->description }}</p>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Applicant Name</th>
                            <th>Date Applied</th>
                            <th>Status</th>
                            <th>Actions</th>
                            <th>CV</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applicants as $applicant)
                            <tr>
                                <td>{{ $applicant->name }}</td>
                                <td>{{ $applicant->pivot->created_at->format('d M Y') }}</td>
                                <td>{{ $applicant->pivot->status }}</td>
                                <td>
                                    <form action="{{ route('applications.updateStatus', ['jobPostId' => $applicant->pivot->job_post_id, 'userId' => $applicant->pivot->user_id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="accepted">
                                        <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to accept this application?')">
                                            Accept
                                        </button>
                                    </form>
                                    <form action="{{ route('applications.updateStatus', ['jobPostId' => $applicant->pivot->job_post_id, 'userId' => $applicant->pivot->user_id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to reject this application?')">
                                            Reject
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('cv.view', ['jobPostId' => $applicant->pivot->job_post_id, 'userId' => $applicant->pivot->user_id]) }}" class="btn btn-info" target="_blank">View CV</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="{{asset('assets/DashboardScript.js')}}"></script>
  </body>
</html>

<style>
    /* Container */
.container {
    flex: 7;
    padding: 20px 40px 20px 24px;
    background: linear-gradient(#e2e2e2, #c9d6ff);
}

/* Main Content */
.main {
    display: flex;
}

/* Content */
.content {
    flex: 9;
}

/* Table */
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

/* Button Styles */
.btn {
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    color: #fff;
}

.btn-success {
    background-color: #28a745;
}

.btn-danger {
    background-color: #dc3545;
}

.btn-info {
    background-color: #17a2b8;
}
</style>