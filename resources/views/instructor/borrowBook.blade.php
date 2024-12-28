<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/png" href="/icons/stcLogo.png">
    <title>Borrow</title>

</head>

<body>
    <div class="mainCont d-flex text-white">

        @include('instructor.layouts.side')

        <!-- content here -->
        <div class="d-flex min-vh-100" style="width: 200%;">

            <div class="card min-vh-100 cardBorder" style="width: 200%;">

                @include('instructor.layouts.header')

                <div class="card-body mainDisplay">
                    <div class="text-center">
                        <h1>Borrow this Book?</h1>
                    </div>
                    <div class="m-5">

                        <form action="{{ route('thisBook') }}" class="row text-dark fs-4" method="post">
                            @csrf
                            <div class="col-md-6">
                                <label for="inputName" class="form-label">Name</label>
                                <input type="text" class="fs-4 form-control" id="inputName" name="name"
                                    value="{{ session('user') }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="inputName" class="form-label">User I.D</label>
                                <input type="text" class="fs-4 form-control" id="inputName" name="libraryId"
                                    value="{{ session('libId') }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="inputAccNo" class="form-label">Acc No.</label>
                                <input type="text" class="fs-4 form-control" id="inputAccNo" name="accNo"
                                    value="{{ $list->isNotEmpty() ? $list->first()->accNo : '' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="inputDate" class="form-label">Date & Time</label>
                                <input type="text" class="fs-4 form-control" id="inputDate" name="date"
                                    value="{{ $todayDate }} at {{ $borrowingTime }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="inputTitle" class="form-label">Title of the Book</label>
                                <input type="text" class="fs-4 form-control" id="inputTitle" name="title"
                                    value="{{ $list->isNotEmpty() ? $list->first()->title : '' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="inputTitle" class="form-label">Author of the Book</label>
                                <input type="text" class="fs-4 form-control" id="inputAuthor"
                                    value="{{ $list->isNotEmpty() ? $list->first()->author : '' }}" readonly>
                            </div>
                            <div class="col-md-max">
                                <label for="exampleFormControlTextarea1" class="form-label">Synopsis</label>
                                <textarea class="form-control fs-4" id="exampleFormControlTextarea1" rows="3" readonly>{{ $list->isNotEmpty() ? $list->first()->synopsis : '' }}</textarea>
                            </div>
                            <div>
                                <button type="submit" name="submit" class="btn btn-success">Borrow</button>
                            </div>
                        </form>
                        <a href="{{ route('instructor.searchBook') }}">
                            <button type="submit" class="btn btn-danger mt-2">Return</button>
                        </a>
                    </div>


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
