<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">

      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/profile*') ? 'active' : '' }}" aria-current="page" href="/dashboard/profile">
            <span data-feather="home"></span>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/loan/create') ? 'active' : '' }}" href="/dashboard/loan/create">
            <span data-feather="file-text"></span>
            Loan Book
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/loan') ? 'active' : '' }}" href="/dashboard/loan">
              <span data-feather="file-text"></span>
              Loan Activity
            </a>
          </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <span data-feather="external-link"></span>
              Go to...
          </a>
          <ul class="dropdown-menu mx-3" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/"><i class="bi bi-dash-square-dotted"></i>Home</a></li>
            <li><a class="dropdown-item" href="/books"><i class="bi bi-dash-square-dotted"></i>Books</a></li>
            <li><a class="dropdown-item" href="/categories"><i class="bi bi-dash-square-dotted"></i>Categories</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/developers"><i class="bi bi-dash-square-dotted"></i>Developers</a></li>
            <li></li>
          </ul>
        </li>
      </ul>

      @can("isAdmin")
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Administrator</span>
        </h6>
        
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/requests') ? 'active' : '' }}" href="/dashboard/requests">
              <span data-feather="grid"></span>
              Loan Requests
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/authors*') ? 'active' : '' }}" href="/dashboard/authors">
              <span data-feather="grid"></span>
              Manage Authors
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/categories') ? 'active' : '' }}" href="/dashboard/categories">
              <span data-feather="grid"></span>
              Manage Categories
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/books*') ? 'active' : '' }}" href="/dashboard/books">
              <span data-feather="grid"></span>
              Manage Books
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/developers*') ? 'active' : '' }}" href="/dashboard/developers">
              <span data-feather="grid"></span>
              Developers List
            </a>
          </li>
        </ul>
      @endcan
    </div>
</nav>