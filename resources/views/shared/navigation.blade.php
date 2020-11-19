<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/">Student Administration Application</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/login">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/courses">Courses</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="/login"><i class="fas fa-sign-in-alt"></i>Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register"><i class="fas fa-signature"></i>Register</a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#!" data-toggle="dropdown">
                            {{ auth()->user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            @if(auth()->user()->admin)

                                <a class="dropdown-item" href="/admin/progammes"><i class="fas fa-microphone-alt"></i>Programmes</a>
                                <a class="dropdown-item" href="/admin/courses"><i class="fas fa-compact-disc"></i>Courses</a>
                                <div class="dropdown-divider"></div>
                            @endif
                            <a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt"></i>Logout</a>
                        </div>
                    </li>
                @endauth
            </ul>

        </div>
    </div>
</nav>
