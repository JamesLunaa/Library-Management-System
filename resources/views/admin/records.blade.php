<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/png" href="/icons/stcLogo.png">
    <title>Records</title>
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
                        <h1>Records</h1>
                    </div>
                    <div class="d-flex gap-2">
                        <div class="d-flex flex-fill gap-2">
                            <form action="{{ route('records') }}" class="d-flex flex-fill gap-2" method="post">
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
                            <a href="{{ route('admin.records') }}"><button type="submit"
                                    class="btn btn-lg btn-secondary">Reload</button></a>
                        </div>
                    </div>

                    <section class="userList mt-4">
                        <div class="recHeight">

                            <table class="table table-dark">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Library ID</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Acc No.</th>
                                        <th scope="col">Request Date</th>
                                        <th scope="col">Borrowed Date</th>
                                        <th scope="col">Returned Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($recordsList as $record)
                                        <tr>
                                            <td>{{ $record->name }}</td>
                                            <td>{{ $record->libraryId }}</td>
                                            <td>{{ $record->title }}</td>
                                            <td>{{ $record->accNo }}</td>
                                            <td>{{ $record->date }}</td>
                                            <td>{{ $record->borrowedDate }}</td>
                                            <td>{{ $record->return_date }}</td>
                                            <td>{{ $record->status }}</td>
                                            <td>{{ $record->remarks }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($recordsList->isEmpty())
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
