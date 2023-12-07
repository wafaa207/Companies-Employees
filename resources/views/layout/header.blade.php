<div>

    <header class="navbar navbar-expand-md d-print-none sticky-top" >
        <div class="container-xl">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-nav flex-row order-md-last">
                <div class="nav-item">
                    <div>
                        <a href="{{ route('logout') }}"  onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                        <form action="{{ route('logout') }}" id="logout-form" method="post">@csrf</form>
                    </div>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('companies.index') }}" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                            <span class="nav-link-title">
                                Companies
                            </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('employees.index') }}" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                            <span class="nav-link-title">
                                Employees
                            </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
</div>
