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
                            <form action="{{ route('bookListAdmin') }}" class="flex-fill d-flex gap-2" method="post">
                                @csrf
                                <div class="input-group input-group-lg mb-3">
                                    <input id="search-input" name="info" type="text" class="form-control shadow-sm"
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

                    @if (session('success'))
                        <div class="alert alert-success" id="success-alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" id="error-alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="list shadow rounded-3 pt-3">
                        <h3 class="text-center">Book List</h3>
                        <hr>

                        <div id="bookListContainer" class="d-flex flex-wrap justify-content-center border-start rounded-3 p-4 gap-5 bookList">
                            @foreach ($list as $books)
                                @php
                                    // Determine the status color based on book_status
                                    $statusColor =
                                        $books->book_status == 'Available' ? 'color: #00FA9A;' : 'color: gold;';

                                    // Determine if the buttons should be disabled based on conditions
                                    $availableDisabled = $books->book_status == 'Available' ? 'disabled' : '';
                                    $unavailableDisabled = $books->book_status == 'Unavailable' ? 'disabled' : '';
                                @endphp


                            <div class='col-12 col-sm-6 col-md-4 col-lg-3 d-flex'>
                                <div class='card ind text-center h-100 d-flex flex-column'>
                                    <img src='/BookCovers/{{ $books->image_path }}' class='card-img-top'
                                        alt='Book cover for {{ $books->title }}' style='height: 13rem; width: auto;'
                                        onerror="this.onerror=null;this.src='/icons/borrowedBook.png';">

                                    <div class='card-body text-white d-flex flex-column'>
                                        <h5 class='card-title fw-bold fs-4'>{{ $books->title }}</h5><br>
                                        <h5 class='card-title'>Acc No. {{ $books->accNo }}</h5><br>
                                        
                                        <!-- Flexible content to push footer down -->
                                        <div class="flex-grow-1"></div>
                                    </div>

                                    <!-- Buttons to change status (moved to the bottom) -->
                                    <div class="card-footer mt-auto" style="background-color: maroon">
                                        <h5 class="card-title" style="{{ $statusColor }}">
                                            {{ $books->book_status }}</h5>
                                        <form method="POST" action="{{ route('changeStat') }}" onsubmit="return confirmStatus()">
                                            @csrf
                                            <input type="hidden" name="accNo" value="{{ $books->accNo }}">
                                            <button type="submit" name="new_status" value="Available" class="btn btn-success" {{ $availableDisabled }}>
                                                Available
                                            </button>
                                            <button type="submit" name="new_status" value="Unavailable" class="btn btn-danger" {{ $unavailableDisabled }}>
                                                Unavailable
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @if ($list->isEmpty())
                                <div class="text-center fs-4 text-danger"><strong>Empty!</strong></div>
                            @else
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Wait for the DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Function to hide alerts after a specified duration
            function hideAlert(alertId) {
                const alert = document.getElementById(alertId);
                if (alert) {
                    setTimeout(() => {
                        alert.style.display = 'none'; // Hide the alert
                    }, 5000); // 5000 milliseconds = 5 seconds
                }
            }

            // Call the hideAlert function for both success and error alerts
            hideAlert('success-alert');
            hideAlert('error-alert');
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            // Trigger AJAX search on keyup event
            $('#search-input').on('keyup', function () {
                const query = $(this).val();
    
                $.ajax({
                    url: "{{ route('ajax.bookSearch') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        info: query
                    },sss
                    success: function (response) {
                        // Clear current book list
                        $('#bookListContainer').empty();
    
                        // Check if results are empty
                        if (response.length === 0) {
                            $('#bookListContainer').html('<div class="text-center fs-4 text-danger"><strong>No results found!</strong></div>');
                        } else {
                            // Populate book list with new results
                            response.forEach(book => {
                                const statusColor = book.book_status === 'Available' ? 'color: #00FA9A;' : 'color: gold;';
                                const availableDisabled = book.book_status === 'Available' ? 'disabled' : '';
                                const unavailableDisabled = book.book_status === 'Unavailable' ? 'disabled' : '';
    
                                $('#bookListContainer').append(`
                                    <div class='col-12 col-sm-6 col-md-4 col-lg-3 d-flex'>
                                        <div class='card ind text-center h-100 d-flex flex-column'>
                                            <img src='/BookCovers/${book.image_path}' class='card-img-top'
                                                alt='Book cover for ${book.title}' style='height: 13rem; width: auto;'
                                                onerror="this.onerror=null;this.src='/icons/borrowedBook.png';">

                                            <div class='card-body text-white d-flex flex-column'>
                                                <h5 class='card-title fw-bold fs-4'>${book.title}</h5><br>
                                                <h5 class='card-title'>Acc No. ${book.accNo}</h5><br>
                                                
                                                <!-- Flexible content to push footer down -->
                                                <div class="flex-grow-1"></div>
                                            </div>

                                            <!-- Buttons to change status (moved to the bottom) -->
                                            <div class="card-footer mt-auto" style="background-color: maroon">
                                                <h5 class="card-title" style="${statusColor}">
                                                    ${book.book_status}</h5>
                                                <form method="POST" action="{{ route('changeStat') }}" onsubmit="return confirmStatus()">
                                                    @csrf
                                                    <input type="hidden" name="accNo" value="${book.accNo}">
                                                    <button type="submit" name="new_status" value="Available" class="btn btn-success" ${availableDisabled}>
                                                        Available
                                                    </button>
                                                    <button type="submit" name="new_status" value="Unavailable" class="btn btn-danger" ${unavailableDisabled}>
                                                        Unavailable
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                `);
                            });
                        }
                    },
                    error: function () {
                        $('#bookListContainer').html('<div class="text-center fs-4 text-danger"><strong>Error loading results.</strong></div>');
                    }
                });
            });
        });
    </script>
    
</body>

</html>
