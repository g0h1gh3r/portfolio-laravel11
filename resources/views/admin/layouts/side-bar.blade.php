@php
    $user = \App\Models\User::first();
@endphp

<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <div class="form-inline mr-auto"></div>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ $user->name }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('profile.edit') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <a href="{{ route('admin.settings.index') }}" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="#" onclick="event.preventDefault();
                                        this.closest('form').submit();"
                       class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </form>
                <form method="POST" action="{{ route('logout') }}">

                </form>
            </div>
        </li>
    </ul>
</nav>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item {{ setSidebarActive(['dashboard']) }}">
                <a href="{{route('dashboard')}}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>

            <li class="menu-header">Sections</li>
            <li class="nav-item dropdown {{ setSidebarActive(['admin.typer-title.*','admin.hero.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Hero</span></a>
                <ul class="dropdown-menu " style="display: none;">
                    <li class="{{ setSidebarActive(['admin.typer-title.*']) }}"><a class="nav-link" href="{{ route('admin.typer-title.index') }}">Typer Title</a></li>
                    <li class="{{ setSidebarActive(['admin.hero.*']) }}"><a class="nav-link" href="{{ route('admin.hero.index') }}">Hero section</a></li>
                </ul>
            </li>

            <li class="{{ setSidebarActive(['admin.service.*']) }}"><a class="nav-link" href="{{ route('admin.service.index') }}"><i class="far fa-square"></i> <span>Service</span></a></li>

            <li class="{{ setSidebarActive(['admin.about.*']) }}"><a class="nav-link" href="{{ route('admin.about.index') }}"><i class="far fa-square"></i> <span>About</span></a></li>

            <li class="nav-item dropdown {{ setSidebarActive(['admin.portfolio-category.*','admin.portfolio-item.*','admin.portfolio-section-setting.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Portfolio</span></a>
                <ul class="dropdown-menu" style="display: none;">
                    <li class="{{ setSidebarActive(['admin.portfolio-category.*']) }}"><a class="nav-link" href="{{ route('admin.portfolio-category.index') }}">Category</a></li>
                    <li class="{{ setSidebarActive(['admin.portfolio-item.*']) }}"><a class="nav-link" href="{{ route('admin.portfolio-item.index') }}">Portfolio Items</a></li>
                    <li class="{{ setSidebarActive(['admin.portfolio-section-setting.*']) }}"><a class="nav-link" href="{{ route('admin.portfolio-section-setting.index') }}">Section Setting</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown {{ setSidebarActive(['admin.skill-item.*','admin.skill-section-setting.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Skill</span></a>
                <ul class="dropdown-menu" style="display: none;">
                    <li class="{{ setSidebarActive(['admin.skill-item.*']) }}"><a class="nav-link" href="{{ route('admin.skill-item.index') }}">Skill Items</a></li>
                    <li class="{{ setSidebarActive(['admin.skill-section-setting.*']) }}"><a class="nav-link" href="{{ route('admin.skill-section-setting.index') }}">Skill Settings</a></li>
                </ul>
            </li>

            <li class="{{ setSidebarActive(['admin.experience.*']) }}"><a class="nav-link" href="{{ route('admin.experience.index') }}"><i class="far fa-square"></i> <span>Experience</span></a></li>

            <li class="nav-item dropdown {{ setSidebarActive(['admin.feedback.*','admin.feedback-section-setting.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Feedback</span></a>
                <ul class="dropdown-menu" style="display: none;">
                    <li class="{{ setSidebarActive(['admin.feedback.*']) }}"><a class="nav-link" href="{{ route('admin.feedback.index') }}">Feedback</a></li>
                    <li class="{{ setSidebarActive(['admin.feedback-section-setting.*']) }}"><a class="nav-link" href="{{ route('admin.feedback-section-setting.index') }}">Section Setting</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown  {{ setSidebarActive(['admin.blog-category.*','admin.blog.*', 'admin.blog-section-setting.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Blog</span></a>
                <ul class="dropdown-menu" style="display: none;">
                    <li class="{{ setSidebarActive(['admin.blog-category.*']) }}"><a class="nav-link" href="{{ route('admin.blog-category.index') }}">Category</a></li>
                    <li class="{{ setSidebarActive(['admin.blog.*']) }}"><a class="nav-link" href="{{ route('admin.blog.index') }}">Blog List</a></li>
                    <li class="{{ setSidebarActive(['admin.blog-section-setting.*']) }}"><a class="nav-link" href="{{ route('admin.blog-section-setting.index') }}">Blog Section Setting</a></li>
                </ul>
            </li>
{{--            <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li>--}}
            <li class="nav-item dropdown {{ setSidebarActive(['admin.contact-section-setting.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Contact</span></a>
                <ul class="dropdown-menu" style="display: none;">
                    <li class="{{ setSidebarActive(['admin.contact-section-setting.*']) }}"><a class="nav-link" href="{{ route('admin.contact-section-setting.index') }}">Contact Section Setting</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown {{ setSidebarActive([
                'admin.footer-social-link.*',
                'admin.footer-info.*',
                'admin.footer-contact-info.*',
                'admin.footer-useful-link.*',
                'admin.footer-help-link.*',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Footer</span></a>
                <ul class="dropdown-menu" style="display: none;">
                    <li class="{{ setSidebarActive(['admin.footer-social-link.*']) }}"><a class="nav-link" href="{{ route('admin.footer-social-link.index') }}">Footer Social Links</a></li>
                    <li class="{{ setSidebarActive(['admin.footer-info.*']) }}"><a class="nav-link" href="{{ route('admin.footer-info.index') }}">Footer Information</a></li>
                    <li class="{{ setSidebarActive(['admin.footer-contact-info.*']) }}"><a class="nav-link" href="{{ route('admin.footer-contact-info.index') }}">Footer Contact Information</a></li>
                    <li class="{{ setSidebarActive(['admin.footer-useful-link.*']) }}"><a class="nav-link" href="{{ route('admin.footer-useful-link.index') }}">Footer Useful Links</a></li>
                    <li class="{{ setSidebarActive(['admin.footer-help-link.*']) }}"><a class="nav-link" href="{{ route('admin.footer-help-link.index') }}">Footer Help Links</a></li>
                </ul>
            </li>

            <li class="{{ setSidebarActive(['admin.settings.index'])}}"><a class="nav-link  }} " href="{{ route('admin.settings.index') }}"><i class="far fa-square"></i> <span>Settings</span></a></li>
        </ul>
    </aside>
</div>
