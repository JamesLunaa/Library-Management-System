<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/png" href="/icons/stcLogo.png">
    <title>Attendance</title>

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
                        <h1>Attendance</h1>
                    </div>
                    <div class="text-center mx-4">

                        <div class="d-flex gap-2">

                            <div class="d-flex flex-fill gap-2">
                                <form action="{{ route('attendance') }}" class="d-flex flex-fill gap-2" method="post">
                                    @csrf
                                    <div class="input-group input-group-lg gap-3">
                                        <input name="info" type="text" class="form-control"
                                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"
                                            placeholder="Search user I.D" required>
                                        <input name="year" type="text" class="form-control"
                                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"
                                            placeholder="Year" required>
                                    </div>
                                    <a href=""><button name="search" class="btn btn-primary text-white btn-lg"
                                            type="submit">Search</button></a>

                                </form>
                                <a href="{{ route('admin.attendance') }}"><button type="submit"
                                        class="btn btn-lg btn-secondary">Reload</button></a>
                            </div>
                        </div>

                    </div>

                    <section class="userList mt-5">
                        <div class="recHeight">

                            <table class="table table-dark">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Library ID</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($attendanceList as $attendance)
                                        <tr>

                                            <td>{{ $attendance->name }}</td>
                                            <td>{{ $attendance->libraryId }}</td>
                                            <td>{{ $attendance->date }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($attendanceList->isEmpty())
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
