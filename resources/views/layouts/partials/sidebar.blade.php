<!-- partial:partials/_sidebar.html -->
<aside class="mdc-drawer mdc-drawer--dismissible mdc-drawer--open">
    <div class="mdc-drawer__header">
        <a href="{{ url('/admin') }}" class="brand-logo">
            <img src="{{ asset('images/sp-book.png') }}" alt="logo">
            <h3 style="color: white;">SPECTRUM BOOKS</h3>
        </a>
    </div>
    <div class="mdc-drawer__content">
        <div class="user-info">
            <p class="email">{{ Auth::guard('admin')->user()->email }}</p>
        </div>
        <div class="mdc-list-group">
            <nav class="mdc-list mdc-drawer-menu">
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{ url('/admin/dashboard') }}">
                        <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon"
                            aria-hidden="true">home</i>
                        Dashboard
                    </a>
                </div>
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{ url('/licenses/user-licenses') }}">
                        <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon"
                            aria-hidden="true">track_changes</i>
                        User License
                    </a>
                </div>
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{ url('/licenses/generated-licenses') }}">
                        <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon"
                            aria-hidden="true">grid_on</i>
                        Generated Licenses
                    </a>
                </div>
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{ url('/books/uploaded-books') }}">
                        <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon"
                            aria-hidden="true">library_books</i>
                        Uploaded Books
                    </a>
                </div>
                @if(Auth::guard('admin')->user()->is_super_admin == 1)
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{ url('/accounts/activate-accounts') }}">
                        <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon"
                            aria-hidden="true">check</i>
                        Activate Accounts
                    </a>
                </div>
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{ url('/admin/manage-access-keys') }}">
                        <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon"
                            aria-hidden="true">code</i>
                        API Access Keys
                    </a>
                </div>
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{ url('/licenses/accounting-module') }}">
                        <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon"
                            aria-hidden="true">euro_symbol</i>
                        Accounting Module
                    </a>
                </div>
                @endif
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{ url('/admin/audit-logs') }}">
                        <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon"
                            aria-hidden="true">pie_chart_outlined</i>
                        Audit Logs
                    </a>
                </div>
                <div class="profile-actions">
                    <a href="javascript:;">Settings</a>
                    <span class="divider"></span>
                    <a href="{{ route('admin.logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
      
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>

        </div>
</aside>
