<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route("index") }}">{{ config('app.name', 'Library') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route("index") }}">Home</a>
            </li>
            @employee
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Employee
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('employeeApprovalRequests') }}">Approval Requests</a>
                    <a class="dropdown-item" href="{{ route('employeeLeasedList') }}">List of Leased</a>
                    <a class="dropdown-item" href="{{ route('employeeReturnedList') }}">List of Returned</a>
                </div>
            </li>
            @endemployee
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endif
            @else
                @if (Route::has('logout'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>
                @endif
            @endguest
        </ul>
        @auth()
            <div class="my-2 my-lg-0 text-light">
                {{ auth()->user()->fullName }}
            </div>
        @endauth
    </div>
</nav>

