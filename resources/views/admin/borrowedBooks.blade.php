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

        @include('admin.layouts.side')

        <!-- content here -->
        <div class="d-flex min-vh-100" style="width: 200%;">

            <div class="card min-vh-100 cardBorder" style="width: 200%;">

                @include('admin.layouts.header')

                <div class="card-body mainDisplay">
                    <div class="text-center">
                        <h1>Borrowed Books</h1>
                    </div>
                    <div class="text-center mt-2 mx-4">
                        <div class="d-flex gap-2">

                            <form action="{{ route('borrowedBooks') }}" class="flex-fill d-flex gap-2" method="post">
                                @csrf
                                <div class="input-group input-group-lg mb-3">
                                    <input name="info" type="text" class="form-control shadow-sm"
                                        placeholder="Search user I.D or Book Acc No.">
                                </div>
                                <a href="">
                                    <button name="search" class="btn btn-primary text-white btn-lg"
                                        type="submit">Search</button>
                                </a>
                            </form>
                            <a href="{{ route('admin.borrowedBooks') }}"><button type="submit"
                                    class="btn btn-lg btn-secondary">Reload</button></a>
                        </div>
                    </div>

                    <section class="mt-4">
                        <div class="reqHeight">

                            <table class="table table-dark">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Library ID</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Acc No.</th>
                                        <th scope="col">Request Date</th>
                                        <th scope="col">Borrowed Date</th>
                                        <th scope="col">Delayed</th>
                                        <th scope="col">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($borrowed as $borrow)
                                        <tr>
                                            <td>{{ $borrow->name }}</td>
                                            <td>{{ $borrow->libraryId }}</td>
                                            <td>{{ $borrow->title }}</td>
                                            <td>{{ $borrow->accNo }}</td>
                                            <td>{{ $borrow->date }}</td>
                                            <td>{{ $borrow->borrowedDate }}</td>
                                            <td>{{ $borrow->delay }} Day/s</td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <form action="{{ route('markReturned') }}" method="POST"
                                                        onsubmit="return confirm('Are you sure you want to mark as returned?')">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $borrow->id }}">
                                                        <button class="btn btn-success" type="submit" name="returned"
                                                            value="{{ $borrow->accNo }}">Returned</button>
                                                    </form>

                                                    <form action="{{ route('markLost') }}" method="POST"
                                                        onsubmit="return confirm('Are you sure you want to mark as lost?')">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $borrow->id }}">
                                                        <button class="btn btn-danger" type="submit" name="lost"
                                                            value="{{ $borrow->accNo }}">Lost</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($borrowed->isEmpty())
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
