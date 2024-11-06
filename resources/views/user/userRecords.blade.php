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
    <div id="no-scroll" class="mainCont d-flex text-white">

        @include('user.layouts.side')

        <!-- content here -->
        <div class="d-flex min-vh-100" style="width: 200%;">

            <div class="card min-vh-100 cardBorder" style="width: 200%;">

                @include('user.layouts.header')

                <div class="card-body mainDisplay">
                    <div id="page-title" class="text-center mb-5">
                        <h1>Records</h1>
                    </div>
                    <div id="margin-form" class="text-center mt-4 mx-4">
                        <div class="d-flex gap-2">
                            <form id="search-form" action="{{ route('userRecords') }}" class="flex-fill d-flex gap-2" method="post">
                                @csrf
                                <div class="input-group input-group-lg mb-3">
                                    <input name="info" type="number" class="form-control shadow-sm"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"
                                        placeholder="Search Acc No.">
                                </div>

                                <div class="d-flex gap-2">
                                    <a href=""><button name="search" class="btn btn-primary text-white btn-lg"
                                            type="submit">Search</button></a>
                                </div>
                            </form>
                            <a id="remove-reload" href="{{ route('user.records') }}"><button type="submit"
                                    class="btn btn-lg btn-secondary">Reload</button></a>
                        </div>
                    </div>

                    <section class="userList mt-4">
                        <div id="request-height" class="recHeight">
                            <table class="table table-bordered table-dark">
                                <thead class="text-center">
                                    <tr>
                                        <th id="record-name" scope="col">Name</th>
                                        <th id="record-id" scope="col">Library I.D</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Acc No.</th>
                                        <th id="record-date" scope="col">Request Date</th>
                                        <th id="borrowed-date" scope="col">Borrowed Date</th>
                                        <th id="" scope="col">Returned Date</th>
                                        <th id="" scope="col">Status</th>
                                        <th id="" scope="col">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">

                                    @foreach ($recordList as $userRecord)
                                        <tr>
                                            <td>{{ $userRecord->name }}</td>
                                            <td>{{ $userRecord->libraryId }}</td>
                                            <td>{{ $userRecord->title }}</td>
                                            <td>{{ $userRecord->accNo }}</td>
                                            <td>{{ $userRecord->date }}</td>
                                            <td>{{ $userRecord->borrowedDate }}</td>
                                            <td>{{ $userRecord->return_date }}</td>
                                            <td>{{ $userRecord->status }}</td>
                                            <td>{{ $userRecord->remarks }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($recordList->isEmpty())
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
    <script>
        const hamBurger = document.querySelector(".toggle-btn");

        hamBurger.addEventListener("click", function () {
        document.querySelector("#sidebar").classList.toggle("expand");
        });
    </script>
</body>

</html>
