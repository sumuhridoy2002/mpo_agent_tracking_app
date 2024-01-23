<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
      <a class="nav-link @if(request()->path() != 'dashboard') collapsed @endif" href="{{ route('dashboard') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>
    @if($authUser?->role === 'Super Admin')
      <li class="nav-item">
        <a class="nav-link @if(!in_array(request()->path(), ['admins', 'admins/create'])) collapsed @endif" data-bs-target="#manage-admins-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>Manage admins</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="manage-admins-nav" class="nav-content @if(!in_array(request()->path(), ['admins', 'admins/create'])) collapse @endif" data-bs-parent="#sidebar-nav">
          <li>
            <a class="@if(request()->path() == 'admins') active @endif" href="{{ route('admins.index') }}">
              <i class="bi bi-list-columns-reverse"></i><span>Admin List</span>
            </a>
          </li>
          <li>
            <a class="@if(request()->path() == 'admins/create') active @endif" href="{{ route('admins.create') }}">
              <i class="bi bi-person-plus"></i><span>Admin Create</span>
            </a>
          </li>
        </ul>
      </li>
    @endif

  </ul>
</aside>