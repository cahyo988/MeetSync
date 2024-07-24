<nav id="sidebar" class="active">
    <div class="sidebar-header">
        <img src="{{ asset('assets/img/Logota.png') }}" alt="Logoe" width="40" class="nav-logo" height="40">
        <span class="logo-text">MeetSYNC</span>
    </div>
    <ul class="list-unstyled components">
        <li class="{{ Request::is('home') ? 'active' : '' }}">
            <a href="{{ route('home') }}"><i class="fa-solid fa-gauge fa-lg"></i> Dashboard</a>
        </li>
        @if (Auth::check() && Auth::user()->role_id !== 1)
            <li class="{{ Request::is('agenda/view') ? 'active' : '' }}">
                <a href="{{ route('agenda.view') }}"><i class="fa-solid fa-calendar-days fa-lg"></i> Agenda Rapat</a>
            </li>
        @endif
        @if (Auth::check() && Auth::user()->role_id !== 1)
            <li class="{{ Request::is('notulensi/view') ? 'active' : '' }}">
                <a href="{{ route('notulensi.view') }}"><i class="fa-solid fa-book fa-lg"></i> Rekap Notulensi</a>
            </li>
        @endif
        @if (Auth::check() && Auth::user()->role_id !== 1)
            <li class="{{ Request::is('todo') ? 'active' : '' }}">
                <a href="{{ route('todo.index') }}"><i class="fa-solid fa-list fa-lg"></i> Todo List</a>
            </li>
        @endif
        @if (Auth::check() && Auth::user()->role_id == 1)
            <li class="{{ Request::is('users') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}"><i class="fa-solid fa-user fa-lg"></i> Daftar Pengguna</a>
            </li>
        @endif
        @if (Auth::check() && Auth::user()->role_id == 1)
            <li class="{{ Request::is('access_rights') ? 'active' : '' }}">
                <a href="{{ route('access_rights.index') }}"><i class="fa-solid fa-universal-access fa-lg"></i> Hak
                    Akses</a>
            </li>
        @endif
    </ul>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {

            $('ul.list-unstyled.components li').on('click', function() {
                $('ul.list-unstyled.components li').removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>
</nav>
