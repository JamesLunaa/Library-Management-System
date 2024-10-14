<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/png" href="/icons/stcLogo.png">
    <title>Borrowed</title>
</head>

<body>
    <div class="mainCont d-flex text-white">

        @include('user.layouts.side')

        <!-- content here -->
        <div class="d-flex min-vh-100" style="width: 200%;">

            <div class="card min-vh-100 cardBorder" style="width: 200%;">

                @include('user.layouts.header')

                <div class="card-body mainDisplay">
                    <div class="text-center mb-5">
                        <h1>Books in Possession</h1>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('user.borrowedBooks') }}"><button type="submit"
                                class="btn btn-secondary fs-5">Reload</button></a>
                    </div>

                    <section class="userList mt-4">
                        <div class="reqHeight">
                            <table class="table table-bordered table-dark">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Acc No.</th>
                                        <th scope="col">Request Date</th>
                                        <th scope="col">Borrowed Date</th>
                                        <th scope="col">Duration</th>
                                        <th scope="col">Delayed</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @if ($userBorrowed->isEmpty())
                                        <div class="text-center fs-4 text-danger"><strong>Empty!</strong></div>
                                    @else
                                        @foreach ($userBorrowed as $borrowedBooks)
                                            <tr>
                                                <td>{{ $borrowedBooks->title }}</td>
                                                <td>{{ $borrowedBooks->accNo }}</td>
                                                <td>{{ $borrowedBooks->date }}</td>
                                                <td>{{ $borrowedBooks->borrowedDate }}</td>
                                                <td>{{ $borrowedBooks->duration }} Day</td>
                                                <td>{{ $borrowedBooks->delay }} Day/s</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </section>

                </div>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
