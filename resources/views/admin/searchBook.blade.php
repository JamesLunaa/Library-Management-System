<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/png" href="/icons/stcLogo.png">
    <title>Book List</title>
</head>

<body>
    <div class="mainCont d-flex text-white">

        @include('admin.layouts.side')

        <!-- content here -->
        <div class="d-flex min-vh-100" style="width: 200%;">

            <div class="card min-vh-100 cardBorder" style="width: 200%;">

                @include('admin.layouts.header')

                <div class="card-body mainDisplay">

                    <div class="text-center mt-4 mx-4">
                        <div class="d-flex gap-2">
                            <form action="{{ route('bookList') }}" class="flex-fill d-flex gap-2" method="post">
                                @csrf
                                <div class="input-group input-group-lg mb-3">
                                    <input name="info" type="text" class="form-control shadow-sm"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"
                                        placeholder="Search...">
                                </div>

                                <div class="d-flex gap-2">
                                    <a href=""><button name="search" class="btn btn-primary text-white btn-lg"
                                            type="submit">Search</button></a>
                                </div>
                            </form>
                            <a href="{{ route('admin.searchBook') }}"><button type="submit"
                                    class="btn btn-lg btn-secondary">Reload</button></a>
                        </div>
                    </div>

                    <div class="list shadow rounded-3 pt-3">
                        <h3 class="text-center">Book List</h3>
                        <hr>
                        @if ($list->isEmpty())
                            <div class="text-center fs-4 text-danger"><strong>Empty!</strong></div>
                        @else
                            <div
                                class="d-flex flex-wrap justify-content-center border-start rounded-3 p-4 gap-5 bookList">
                                @foreach ($list as $books)
                                    @php
                                        // Determine the status color based on book_status
                                        $statusColor =
                                            $books->book_status == 'Available' ? 'color: #00FA9A;' : 'color: gold;';

                                        // Determine if the buttons should be disabled based on conditions
                                        $availableDisabled =
                                            $books->book_status == 'Available' ||
                                            $books->borrowedbooks_status == 'Approved'
                                                ? 'disabled'
                                                : '';
                                        $unavailableDisabled =
                                            $books->book_status == 'Unavailable' ||
                                            $books->borrowedbooks_status == 'Approved'
                                                ? 'disabled'
                                                : '';
                                    @endphp

                                    <div class='col-12 col-sm-6 col-md-4 col-lg-3'>
                                        <div class='card ind text-center'>
                                            <img src='/BookCovers/{{ $books->image_path }}' class='card-img-top'
                                                alt='Book cover for {{ $books->title }}'
                                                style='height: 13rem; width: auto;'
                                                onerror="this.onerror=null;this.src='/icons/borrowedBook.png';">
                                            <div class='card-body text-white'>
                                                <h5 class='card-title fw-bold fs-4'>{{ $books->title }}</h5><br>
                                                <h5 class='card-title'>Acc No. {{ $books->accNo }}</h5><br>
                                                <h5 class="card-title" style="{{ $statusColor }}">
                                                    {{ $books->book_status }}</h5>

                                                <!-- Buttons to change status -->
                                                <form method="POST" action="{{ route('changeStat') }}"
                                                    onsubmit="return confirmStatus()">
                                                    @csrf
                                                    <input type="hidden" name="accNo" value="{{ $books->accNo }}">
                                                    <button type="submit" name="new_status" value="Available"
                                                        class="btn btn-success"
                                                        {{ $availableDisabled }}>Available</button>
                                                    <button type="submit" name="new_status" value="Unavailable"
                                                        class="btn btn-danger"
                                                        {{ $unavailableDisabled }}>Unavailable</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>