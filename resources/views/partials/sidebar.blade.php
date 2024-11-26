<aside id="sidebar">
    <div class="h-100">
        <div class="sidebar-logo">
            <a href="#" class="ms-2 d-flex align-items-center">
                <img src="{{ asset('images/logo.png') }}" alt="PRM Logo" class="logo img-fluid" />
                <span class="fw-bold ms-2 mt-2">PRM</span>
            </a>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-header mt-3">
                Navigation
            </li>
            <x-sidebar-item route="dashboard">
                <i class="bi bi-speedometer"></i>
                Dashboard
            </x-sidebar-item>
            <x-sidebar-item route="pos">
                <i class="bi bi-clipboard-data-fill"></i>
                Point of sales
            </x-sidebar-item>
            <x-sidebar-item route="inventory">
                <i class="bi bi-box-seam-fill"></i>
                Inventory
            </x-sidebar-item>
            <x-sidebar-item route="stock_in">
                <i class="bi bi-basket-fill"></i>
                Stock In
            </x-sidebar-item>
            <x-sidebar-item route="transactions">
                <i class="bi bi-graph-up-arrow"></i>
                Transactions
            </x-sidebar-item>
        </ul>
    </div>
</aside>