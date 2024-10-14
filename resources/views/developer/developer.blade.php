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

        @include('developer.layouts.side')

        <!-- content here -->
        <div class="d-flex min-vh-100" style="width: 200%;">

            <div class="card min-vh-100 cardBorder" style="width: 200%;">

                @include('developer.layouts.header')

                <div class="card-body mainDisplay">
                    <div class="text-center">
                        <h1>Records</h1>
                    </div>

                    <section class="userList mt-4">
                        <div class="recHeight">
                            @if ($feedbacks->isEmpty())
                                <div class="text-center fs-4 text-danger"><strong>Empty!</strong></div>
                            @else
                                <table class="table table-dark">
                                    <thead class="text-center">
                                        <tr>
                                            <th scope="col">User I.D</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Feedbacks</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($feedbacks as $list)
                                            <tr>
                                                <td>{{ $list->userId }}</td>
                                                <td>{{ $list->date }}</td>
                                                <td>{{ $list->info }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
