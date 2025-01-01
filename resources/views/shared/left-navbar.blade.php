<ul class="navbar-nav me-auto">
    <li class="nav-item text-center {{ request()->routeIs('home') ? 'active' : '' }}">
         <a class="nav-link" href="{{ route('home') }}">Home</a>
    </li>
    <li class="nav-item text-center {{ request()->routeIs('subjects.index') ? 'active' : '' }}">
         <a class="nav-link" href="{{ route('subjects.index') }}">Subjects</a>
    </li>
    <li class="nav-item text-center {{ request()->routeIs('lectures.index') ? 'active' : '' }}">
         <a class="nav-link" href="{{ route('lectures.index') }}">Lectures</a>
    </li>
    <li class="nav-item text-center {{ request()->routeIs('exam-papers.index') ? 'active' : '' }}">
         <a class="nav-link" href="{{ route('exam-papers.index') }}">Exam Papers</a>
    </li>
</ul>
