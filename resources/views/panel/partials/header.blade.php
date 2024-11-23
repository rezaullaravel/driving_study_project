<div class="container-fluid">

    <header class="dd-head mb-4">
      <div class="left d-flex gap-3 align-items-center">
        <div class="dashboard-body__bar">
          <span class="dashboard-body__bar-icon"><i class="fa-solid fa-bars"></i></span>
        </div>
        <div class="info--wrap">
          <h4 class="title">Home</h4>
          <p class="time">{{ date('d-m-Y') }}</p>
        </div>
      </div>

      <div class="right">
        <ul class="d-flex">
          <li>
            <a class="d-icon" href="#">
              <iconify-icon icon="tabler:settings"></iconify-icon>
            </a>
          </li>
          <li>
            <a class="d-icon dropdown-toggle" href href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-regular fa-bell"></i>
            </a>

            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <a class="dropdown-item" href="#">Something else here</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#" class="u-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">

              <div class="u-img">
                @if (!empty(Auth::user()->image))
                <img src="{{ asset(Auth::user()->image) }}" alt="user" />
                @else
                 <img src="{{ asset('/') }}panel/assets/img/user/u1.jpg" alt="user" />
                @endif
              </div>

              <div class="u-content">
                <h5 class="name">{{ Auth::user()->name }}</h5>
                <p class="email">{{ Auth::user()->email }}</p>
              </div>

              @php
                  $permission_profile = DB::table('permission_roles')
                ->where('role_id',Auth::user()->role_id)
                ->join('permissions','permission_roles.permission_id','=','permissions.id')
                ->where('permissions.slug','profile')
                ->select('permissions.name')
                ->first();
              @endphp

              <ul class="dropdown-menu">
                @if (!empty($permission_profile))
                 <li><a class="dropdown-item" href="{{ url('/profile') }}">Profile</a></li>
                @endif

                <li><a class="dropdown-item" href="{{ url('/password') }}">Password</a></li>
                <li>
                  <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                </li>
              </ul>

            </a>


          </li>
        </ul>
      </div>
    </header>
  </div>
