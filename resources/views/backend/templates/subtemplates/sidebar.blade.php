<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <div>Fikrithings</div>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <div>F</div>
    </div>
    <ul class="sidebar-menu">
      <li class="{{ Route::is('admin.company-profile.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.company-profile.index') }}"><i class="fas fa-user"></i><span>Company Profile</span></a>
      </li>
      <li class="{{ Route::is('admin.category.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.category.index') }}"><i class="fas fa-tag"></i><span>Category</span></a>
      </li>
      <li class="{{ Route::is('admin.article.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.article.index') }}"><i class="fas fa-star"></i><span>Article</span></a>
      </li>
    </ul>
  </aside>
</div>