<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/png" href="/icons/stcLogo.png">
    <title>Approved</title>
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
                        <h1>Approved List</h1>
                    </div>
                    <div class="text-center mt-2 mx-4">
                        <div class="d-flex gap-2">

                            <form action="{{ route('approvedList') }}" class="flex-fill d-flex gap-2" method="post">
                                @csrf
                                <div class="input-group input-group-lg mb-3">
                                    <input name="info" type="text" class="form-control shadow-sm"
                                        placeholder="Search...">
                                </div>
                                <a href="">
                                    <button name="search" class="btn btn-primary text-white btn-lg"
                                        type="submit">Search</button>
                                </a>
                            </form>
                            <a href="{{ route('admin.approvedList') }}"><button type="submit"
                                    class="btn btn-lg btn-secondary">Reload</button></a>
                        </div>
                    </div>

                    <section class="userList">
                        <div class="vh-auto">
                            <div class="text-center">
                                <a href="{{ route('admin.requestInbox') }}"><button name="search"
                                        class="mb-3 btn btn-danger text-white btn-lg" type="submit">Return</button></a>
                            </div>


                            <table class="table table-dark text-center">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Library ID</th>
                                        <th>Title</th>
                                        <th>Acc No</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($approved as $approve)
                                        <tr>
                                            <td>{{ $approve->name }}</td>
                                            <td>{{ $approve->libraryId }}</td>
                                            <td>{{ $approve->title }}</td>
                                            <td>{{ $approve->accNo }}</td>
                                            <td>{{ $approve->date }}</td>
                                            <td>
                                                <button class='btn btn-success' disabled>Approved</button>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <form action="{{ route('markClaimed') }}" method="post"
                                                        onsubmit="return confirm('Are you sure you want to mark as claimed?')">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $approve->id }}">
                                                        <button class="btn btn-success" type="submit" name="claimed"
                                                            value="{{ $approve->accNo }}">Claimed</button>
                                                    </form>

                                                    <form action="{{ route('cancelRequest') }}" method="post"
                                                        onsubmit="return confirm('Are you sure you want to cancel?')">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $approve->id }}">
                                                        <button class="btn btn-danger" type="submit" name="cancel"
                                                            value="{{ $approve->accNo }}">Cancelled</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($approved->isEmpty())
                                <div class="text-center fs-4 text-danger"><strong>Empty!</strong></div>
                            @else
                            @endif

                        </div>
                    </section>

                </div>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
