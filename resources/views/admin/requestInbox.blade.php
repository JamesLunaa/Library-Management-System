<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/png" href="/icons/stcLogo.png">
    <title>Inbox</title>
</head>

<body>
    <div class="mainCont d-flex text-white">

        @include('admin.layouts.side')

        <!-- content here -->
        <div class="d-flex min-vh-100" style="width: 200%;">

            <div class="card min-vh-100 cardBorder" style="width: 200%;">

                @include('admin.layouts.header')

                <div class="card-body mainDisplay">
                    <div class="text-center">
                        <h1>Request Inbox</h1>
                    </div>
                    <div class="text-center mt-2 mx-4">
                        <div class="d-flex gap-2">
                            <form action="{{ route('requestInbox') }}" class="flex-fill mb-3 d-flex gap-2"
                                method="post">
                                @csrf
                                <div class="input-group input-group-lg mb-3">
                                    <input name="info" type="text" class="form-control shadow-sm"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"
                                        placeholder="Search user I.D">
                                </div>
                                <a href="">
                                    <button name="search" class="btn btn-primary text-white btn-lg"
                                        type="submit">Search</button>
                                </a>
                            </form>
                            <a href="{{ route('admin.requestInbox') }}"><button type="submit"
                                    class="btn btn-lg btn-secondary">Reload</button></a>
                        </div>
                    </div>

                    <section class="mt-3">
                        <div class="vh-auto recHeight">

                            <table class="table table-dark">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Library ID</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Acc No.</th>
                                        <th scope="col">Request Date</th>
                                        <th scope="col">Duration</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($requestList as $requests)
                                        <tr>
                                            <td>{{ $requests->name }}</td>
                                            <td>{{ $requests->libraryId }}</td>
                                            <td>{{ $requests->title }}</td>
                                            <td>{{ $requests->accNo }}</td>
                                            <td>{{ $requests->date }}</td>
                                            <td>{{ $requests->duration }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <form action="{{ route('approveRequest') }}" method="post"
                                                        onsubmit="return confirm('Are you sure you want to approve this request?')">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $requests->id }}">
                                                        <button class="btn btn-success" type="submit" name="approve"
                                                            value="{{ $requests->accNo }}">
                                                            Approve
                                                        </button>
                                                    </form>

                                                    <form action="{{ route('rejectRequest') }}" method="post"
                                                        onsubmit="return confirm('Are you sure you want to reject this request?')">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $requests->id }}">
                                                        <button class="btn btn-danger" type="submit" name="reject"
                                                            value="{{ $requests->accNo }}">
                                                            Reject
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($requestList->isEmpty())
                                <div class="text-center fs-4 text-danger">
                                    <strong>Empty!</strong>
                                </div>
                            @else
                            @endif

                        </div>
                    </section>
                    <div class="">
                        <a href="{{ route('admin.approvedList') }}"><button
                                class="mb-2 btn btn-warning text-white">Approved
                                List</button></a>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
