<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#dashboard" data-bs-toggle="collapse" href="#">
        <i class="fa fa-dashboard"></i><span>Dashboard</span><i class="fa fa-chevron-down ms-auto"></i>
    </a>
    <ul id="dashboard" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
            <a href="{{ route('magasin.dashboard') }}">
                <i class="fa fa-circle"></i><span>Global sales</span>
            </a>
        </li>
        <li>
            <a href="{{ route('sale.point.stat') }}">
                <i class="fa fa-circle"></i><span>Sales per point</span>
            </a>
        </li>
        <li>
            <a href="{{ route('benefice') }}">
                <i class="fa fa-circle"></i><span>Benefice</span>
            </a>
        </li>
        <li>
            <a href="{{ route('commission') }}">
                <i class="fa fa-circle"></i><span>Commission</span>
            </a>
        </li>
    </ul>
</li><!-- End Icons Nav -->


<li class="nav-item">
    <a class="nav-link " href="{{ route('laptops.index') }}">
        <i class="fas fa-computer"></i>
        <span>Laptop</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link " href="{{ route('sale-points.index') }}">
        <i class="fas fa-shop"></i>
        <span>Point of sale</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link " href="{{ route('brands.index') }}">
        <i class="fas fa-apple"></i>
        <span>Brand</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link " href="{{ route('processors.index') }}">
        <i class="fas fa-cash-register"></i>
        <span>Processor</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link " href="{{ route('users.index') }}">
        <i class="fas fa-user"></i>
        <span>User</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#stock" data-bs-toggle="collapse" href="#">
        <i class="fas fa-coins"></i><span>Stock</span><i class="fa fa-chevron-down ms-auto"></i>
    </a>
    <ul id="stock" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
            <a href="{{ route('stocks.index') }}">
                <i class="fa fa-circle"></i><span>Purchase</span>
            </a>
        </li>
        <li>
            <a href="{{ route('stocks.group') }}">
                <i class="fa fa-circle"></i><span>Global</span>
            </a>
        </li>
    </ul>
</li><!-- End Icons Nav -->

<li class="nav-item">
    <a class="nav-link " href="{{ route('transfers.index') }}">
        <i class="fa fa-share"></i>
        <span>Transfer</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link " href="{{ route('receptions.magasin') }}">
        <i class="fa fa-hand-holding-hand"></i>
        <span>Reception</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link " href="{{ route('paliers.index') }}">
        <i class="fa fa-money-bill"></i>
        <span>Paliers</span>
    </a>
</li>
