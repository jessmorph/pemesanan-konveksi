<nav class="d-flex flex-column p-3 text-white bg-dark" style="width: 15vw; height: 100vh">
    <a class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <img src="{{ url('static/logo.jpeg') }}" alt="gambar" style="width: 100%;"> 
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a class="nav-link {{ $active === 'onprogress' ? 'active' : '' }}" href="/" aria-current="page">On Progress</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $active === 'input-form' ? 'active' : '' }}" href="/input-form" aria-current="page">Input Form</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $active === 'pending-form' ? 'active' : '' }}" href="/pending-form" aria-current="page">Pending Form</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $active === 'user' ? 'active' : '' }}" href="/user" aria-current="page">User</a>
        </li>
        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            <li class="nav-item">
                <a class="nav-link {{ $active === 'history' ? 'active' : '' }}" href="/history" aria-current="page">History</a>
            </li>
        @endif
    </ul>
</nav>