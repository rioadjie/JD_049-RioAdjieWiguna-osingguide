<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html "
            target="_blank">
            <img src="{{ asset('assets/img/landing-page/osingguide-logo.svg') }}" width="26px" height="26px"
                class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Osing Guide Dashboard</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    @if (Auth::user()->role === 'admin')
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            {{-- Menu --}}
            <li class="nav-item mt-4">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Menu</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.bookings') ? 'active' : '' }}"
                    href="{{ route('admin.bookings') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-calendar-grid-58 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Booking Orders</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.guides') ? 'active' : '' }}"
                    href="{{ route('admin.guides') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-credit-card text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Guide Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.customers') ? 'active' : '' }}"
                    href="{{ route('admin.customers') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-app text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Customer Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.settings.commission') ? 'active' : '' }}"
                    href="{{ route('admin.settings.commission') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-world-2 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Commission Settings</span>
                </a>
            </li>
            {{-- Content Management --}}
            <li class="nav-item mt-2">
                <a class="nav-link {{ request()->routeIs('admin.places*') || request()->routeIs('admin.gallery*') || request()->routeIs('admin.about*') || request()->routeIs('admin.contact*') ? 'active' : '' }}"
                    data-bs-toggle="collapse" href="#masterData" role="button"
                    aria-expanded="{{ request()->routeIs('admin.places*') || request()->routeIs('admin.gallery*') || request()->routeIs('admin.about*') || request()->routeIs('admin.contact*') ? 'true' : 'false' }}"
                    aria-controls="masterData">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-briefcase-24 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Landing Page Content</span>
                </a>
                <div class="collapse {{ request()->routeIs('admin.places*') || request()->routeIs('admin.gallery*') || request()->routeIs('admin.about*') || request()->routeIs('admin.contact*') ? 'show' : '' }}"
                    id="masterData">
                    <ul class="nav flex-column ms-4">
                        <li class="nav-item mt-2">
                            <a class="nav-link {{ request()->routeIs('admin.places*') ? 'active' : '' }}"
                                href="{{ route('admin.places.index') }}">
                                Place to Visit
                            </a>
                        </li>
                        <li class="nav-item mt-2">
                            <a class="nav-link {{ request()->routeIs('admin.gallery*') ? 'active' : '' }}"
                                href="{{ route('admin.gallery.index') }}">
                                Gallery
                            </a>
                        </li>
                        <li class="nav-item mt-2">
                            <a class="nav-link {{ request()->routeIs('admin.about*') ? 'active' : '' }}"
                                href="{{ route('admin.about.index') }}">
                                About
                            </a>
                        </li>
                        <li class="nav-item mt-2">
                            <a class="nav-link {{ request()->routeIs('admin.contact*') ? 'active' : '' }}"
                                href="{{ route('admin.contact.index') }}">
                                Contact
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    @elseif(Auth::user()->role === 'guide')
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('guide.dashboard') ? 'active' : '' }}"
                    href="{{ route('guide.dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('guide.profile.edit') ? 'active' : '' }}"
                    href="{{ route('guide.profile.edit') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-credit-card text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('guide.availability') ? 'active' : '' }}"
                    href="{{ route('guide.availability') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-calendar-grid-58 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Availability</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('guide.bookings') ? 'active' : '' }}"
                    href="{{ route('guide.bookings') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-app text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Bookings</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('guide.reviews') ? 'active' : '' }}"
                    href="{{ route('guide.reviews') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-world-2 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Reviews</span>
                </a>
            </li>
        </ul>
    </div>
    @endif
</aside>
