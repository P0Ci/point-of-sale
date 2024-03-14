<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav ">
      <li class="nav-item text-white">
        <a class="nav-link" href="{{ route('dashboard') }}">
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item nav-category">Master</li>
      <div class="nav-item text-white">
        <a class="nav-link" href="{{ route('product.index') }}">
          <i class="menu-icon  mdi mdi-cube-outline"></i>
          <span class="menu-title">Product</span>
        </a>
      </div>
      @can('admin')
      <div class="nav-item  text-white">
        <a class="nav-link " href="{{ route('category.index') }}">
          <i class="menu-icon mdi mdi-cube-send"></i>
          <span class="menu-title">Kategori</span>
        </a>
      </div>
      <div class="nav-item text-white">
        <a class="nav-link" href="{{ route('member.index') }}">
          <i class="menu-icon  mdi mdi-account-star"></i>
          <span class="menu-title">Member</span>
        </a>
      </div>   
      @endcan
      <li class="nav-item nav-category">Transaksi Penjualan</li>
      <div class="nav-item text-white">
        <a class="nav-link" href="{{ route('penjualan.index') }}">
          <i class="menu-icon  mdi mdi-cash-multiple"></i>
          <span class="menu-title">Transaksi</span>
        </a>
      </div>
      <div class="nav-item text-white">
        <a class="nav-link" href="{{ route('cetak-penjualan') }}">
          <i class="menu-icon mdi mdi-book-multiple "></i>
          <span class="menu-title">Laporan Transaksi</span>
        </a>
      </div>
      @can('admin')
      
      <li class="nav-item nav-category">Management User</li>
      <div class="nav-item text-white">
        <a class="nav-link" href="{{ route('users.index') }}">
          <i class="menu-icon  mdi mdi-account-multiple"></i>
          <span class="menu-title">Users</span>
        </a>
      </div>     
      @endcan
    </ul>
</nav>