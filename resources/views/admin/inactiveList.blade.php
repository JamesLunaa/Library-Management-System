<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/png" href="/icons/stcLogo.png">
    <title>Manage Users</title>

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
                        <h1>Inactive User List</h1>
                    </div>
                    <div class="text-center mt-2 mx-4">
                        <div class="d-flex gap-2">
                            <form action="{{ route('inactiveListSearch') }}" class="flex-fill d-flex gap-2" method="post">
                                @csrf
                                <div class="input-group input-group-lg mb-3">
                                    <input type="number" name="libId" class="form-control shadow-sm"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"
                                        placeholder="Search user I.D">
                                </div>
                                <div class="d-flex gap-2">
                                    <a href=""><button name="search" class="btn btn-primary text-white btn-lg"
                                            type="submit">Search</button></a>
                                </div>
                            </form>
                            <a href="{{ route('inactiveList') }}"><button type="submit"
                                    class="btn btn-secondary btn-lg">Reload</button></a>
                            <div class="text-end">
                                <a href="{{ route('inactiveList') }}"><button type="submit"
                                    class="btn btn-warning btn-lg border border-black" style="color: white !important;">Inactive List</button></a>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('admin.removeUser') }}"><button type="submit"
                                class="btn btn-danger btn-lg">Return</button></a>
                        
                    </div>

                    <section class="userList mt-3">
                        <div class="vh-auto recHeight">
                            <table class="table table-dark">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Library I.D</th>
                                        <th scope="col">User Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($remove as $users)
                                        <tr>
                                            <td>{{ $users->name }}</td>
                                            <td>{{ $users->libraryId }}</td>
                                            <td>
                                                <span style="color: #FA8072;">Inactive!</span>
                                            </td>
                                            <td>
                                                <form action="{{ route('activateUser') }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to activate this user?')">
                                                    @csrf
                                                    <button class="btn btn-warning" type="submit" name="active"
                                                        value="{{ $users->libraryId }}">
                                                        Activate
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($remove->isEmpty())
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
