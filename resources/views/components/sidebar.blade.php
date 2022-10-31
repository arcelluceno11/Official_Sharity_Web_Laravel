<nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-success p-0">
    <div class="container-fluid d-flex flex-column p-0"><a
            class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
            <div class="sidebar-brand-icon"><img src="{{ asset('sharity_white.png') }}" width="40px" height="40px"/></div>
            <div class="sidebar-brand-text mx-3"><span>Sharity</span></div>
        </a>
        <hr class="sidebar-divider my-0" />
        <ul id="accordionSidebar" class="navbar-nav text-light">
            <!-- Manage -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-toggle="collapse" href="#collapseManage" role="button"
                    aria-expanded="false" aria-controls="collapseManage">
                    <i class="fa-solid fa-gear"></i>
                    <span>Manage</span>
                </a>
                <div id="collapseManage" class="collapse">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="admin">Admin</a>
                        <a class="collapse-item" href="charity">Charity</a>
                        <a class="collapse-item" href="driver">Driver</a>
                        <a class="collapse-item" href="donor">Donor/Shopper</a>
                        <a class="collapse-item" href="donation">Donation</a>
                        <a class="collapse-item" href="product">Products</a>
                        <a class="collapse-item" href="purchase">Purchase</a>
                        <a class="collapse-item" href="transaction">Transaction</a>
                    </div>
                </div>
            </li>

            <!-- Reports -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-toggle="collapse" href="#collapseReports" role="button"
                    aria-expanded="false" aria-controls="collapseReports">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Reports</span>
                </a>
                <div id="collapseReports" class="collapse">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" data-bs-toggle="collapse" href="#collapseReportsList" role="button"
                            aria-expanded="false" aria-controls="collapseReportsList">
                            <span>List</span></a>
                        <div id="collapseReportsList" class="collapse">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item" href="">Charity</a>
                                <a class="collapse-item" href="">Donor/Shopper</a>
                                <a class="collapse-item" href="">Order</a>
                                <a class="collapse-item" href="">Transaction</a>
                            </div>
                        </div>
                        <a class="collapse-item" href="">History</a>
                        <a class="collapse-item" href="">Sales</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
