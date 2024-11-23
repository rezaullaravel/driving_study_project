<div class="sidebar-menu">
    <span class="sidebar-menu__close"><i class="fa-solid fa-xmark"></i></span>
    <div class="logo-wrapper">
       <a href="{{ url('dashboard') }}" class="normal-logo" id="normal-logo">
       <img src="{{ asset('/') }}panel/assets/img/logo/logo.png" alt="" /></a>
    </div>
    @php
    $permission_user = DB::table('permission_roles')
    ->where('role_id',Auth::user()->role_id)
    ->join('permissions','permission_roles.permission_id','=','permissions.id')
    ->where('permissions.slug','user')
    ->select('permissions.name')
    ->first();

    $permission_role = DB::table('permission_roles')
    ->where('role_id',Auth::user()->role_id)
    ->join('permissions','permission_roles.permission_id','=','permissions.id')
    ->where('permissions.slug','role')
    ->select('permissions.name')
    ->first();

    $permission_licence_type = DB::table('permission_roles')
        ->where('role_id',Auth::user()->role_id)
        ->join('permissions','permission_roles.permission_id','=','permissions.id')
        ->where('permissions.slug','licencetype')
        ->select('permissions.name')
        ->first();

        $permission_chapter_list = DB::table('permission_roles')
        ->where('role_id',Auth::user()->role_id)
        ->join('permissions','permission_roles.permission_id','=','permissions.id')
        ->where('permissions.slug','chapter')
        ->select('permissions.name')
        ->first();

        $permission_book_list = DB::table('permission_roles')
        ->where('role_id',Auth::user()->role_id)
        ->join('permissions','permission_roles.permission_id','=','permissions.id')
        ->where('permissions.slug','book')
        ->select('permissions.name')
        ->first();

        $permission_question_list = DB::table('permission_roles')
        ->where('role_id',Auth::user()->role_id)
        ->join('permissions','permission_roles.permission_id','=','permissions.id')
        ->where('permissions.slug','questions')
        ->select('permissions.name')
        ->first();

        $permission_package_list = DB::table('permission_roles')
        ->where('role_id',Auth::user()->role_id)
        ->join('permissions','permission_roles.permission_id','=','permissions.id')
        ->where('permissions.slug','packages')
        ->select('permissions.name')
        ->first();
    @endphp
    <ul class="sidebar-menu-list">
       <li class="sidebar-menu-list__item">
          <a href="{{ url('/dashboard') }}" class="sidebar-menu-list__link {{ request()->is('dashboard') ? 'active':'' }}">
             <span class="icon">
                <iconify-icon icon="tabler:home"></iconify-icon>
             </span>
             <span class="text">Home</span>
          </a>
       </li>
       @if (!empty($permission_user))
       <li class="sidebar-menu-list__item">
          <a href="{{route('users')}}" class="sidebar-menu-list__link {{ request()->is('users') ? 'active':'' }}">
             <span class="icon">
                <iconify-icon icon="tabler:cash"></iconify-icon>
             </span>
             <span class="text">User</span>
          </a>
       </li>
       @endif
       @if (!empty($permission_role))
       <li class="sidebar-menu-list__item">
          <a href="{{ route('roles') }}" class="sidebar-menu-list__link {{ request()->is('roles') ? 'active':'' }}">
             <span class="icon">
                <iconify-icon icon="tabler:beach"></iconify-icon>
             </span>
             <span class="text">Role</span>
          </a>
       </li>
       @endif

       @if (!empty($permission_licence_type))
       <li class="sidebar-menu-list__item">
            <a href="{{ route('licencetype.index') }}" class="sidebar-menu-list__link {{ request()->is('licence-type-list') ? 'active':'' }}">
            <span class="icon">
                <iconify-icon icon="tabler:beach"></iconify-icon>
            </span>
            <span class="text">Licence Type</span>
            </a>
        </li>
       @endif

       @if (!empty($permission_chapter_list))
       <li class="sidebar-menu-list__item">
            <a href="{{ route('chapter.index') }}" class="sidebar-menu-list__link {{ request()->is('chapter-list') ? 'active':'' }}">
            <span class="icon">
                <iconify-icon icon="tabler:beach"></iconify-icon>
            </span>
            <span class="text">Chapter</span>
            </a>
        </li>
       @endif

       @if (!empty($permission_book_list))
        <li class="sidebar-menu-list__item">
                <a href="{{ route('book.index') }}" class="sidebar-menu-list__link {{ request()->is('book-list') ? 'active':'' }}">
                <span class="icon">
                    <iconify-icon icon="tabler:beach"></iconify-icon>
                </span>
                <span class="text">Book</span>
                </a>
        </li>
       @endif


       @if (!empty($permission_question_list))
            <li class="sidebar-menu-list__item">
                <a href="{{ route('question.index') }}" class="sidebar-menu-list__link {{ request()->is('questions') ? 'active':'' }}">
                <span class="icon">
                    <iconify-icon icon="tabler:beach"></iconify-icon>
                </span>
                <span class="text">Question</span>
                </a>
            </li>
       @endif

       @if (!empty($permission_package_list))
            <li class="sidebar-menu-list__item">
                <a href="{{ route('package.index') }}" class="sidebar-menu-list__link {{ request()->is('packages') ? 'active':'' }}">
                <span class="icon">
                    <iconify-icon icon="tabler:beach"></iconify-icon>
                </span>
                <span class="text">Package</span>
                </a>
            </li>
       @endif
    </ul>
</div>
