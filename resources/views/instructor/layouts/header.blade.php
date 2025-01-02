<div id="user-header" class="card-header border-secondary">
    <div class="dropdown d-flex justify-content-end">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="/icons/stcLogo.png" alt="" width="60" height="55" class="rounded-circle me-2">
            <strong class="fs-4">{{ session('user') }}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-white text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="{{ route('instructor.changePass') }}">Change Password</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item"
                        onclick="return confirm('Are you sure you want to log out?')">
                        Sign out
                    </button>
                </form>
            </li>
        </ul>
    </div>

</div>
