    <nav class="pc-sidebar">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="../dashboard/index.html" class="b-brand text-primary">
                    <!-- ========   Change your logo from here   ============ -->
                    <img src="{{asset('assets/images/logo-dark.jpg')}}" alt="" class="logo logo-lg">
                </a>
            </div>
            <div class="navbar-content">
                <ul class="pc-navbar">
                    <li class="pc-item pc-caption">
                        <label>Dashboard</label>
                        <i class="ti ti-dashboard"></i>
                    </li>
                    <li class="pc-item active">
                        <a href="" class="pc-link">
                            <span class="pc-micon">
                                <i class="ti ti-dashboard"></i>
                            </span>
                            <span class="pc-mtext">Dashboard</span>
                        </a>
                    </li>
                </ul>

                <ul class="pc-navbar">
                    <li class="pc-item pc-caption">
                        <label>Usuários</label>
                        <i class="ti ti-dashboard"></i>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('user.index') }}" class="pc-link">
                            <span class="pc-micon">
                                <i class="ti ti-user"></i>
                            </span>
                            <span class="pc-mtext">Usuários</span>
                        </a>
                    </li>
                </ul>

                <ul class="pc-navbar">
                    <li class="pc-item pc-caption">
                        <label>Registros</label>
                        <i class="ti ti-dashboard"></i>
                    </li>

                    <li class="pc-item">
                        <a href="" class="pc-link">
                            <span class="pc-micon">
                                <i class="ti ti-list"></i>
                            </span>
                            <span class="pc-mtext">Pedidos</span>
                        </a>
                    </li>

                    <li class="pc-item">
                        <a href="" class="pc-link">
                            <span class="pc-micon">
                                <i class="ti ti-book"></i>
                            </span>
                            <span class="pc-mtext">H. movimentação</span>
                        </a>
                    </li>
                </ul>



                <ul class="pc-navbar">
                    <li class="pc-item pc-caption">
                        <label>Produtos</label>
                        <i class="ti ti-dashboard"></i>
                    </li>

                   <li class="pc-item">
                        <a href="{{ route('products.index') }}" class="pc-link">
                            <span class="pc-micon">
                                <i class="ti ti-shirt"></i>
                            </span>
                            <span class="pc-mtext">Produtos</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('warehouses.index') }}" class="pc-link">
                            <span class="pc-micon">
                                <i class="ti ti-dashboard"></i>
                            </span>
                            <span class="pc-mtext">Estoques</span>
                        </a>
                    </li>
                </ul>

                <ul class="pc-navbar">
                    <li class="pc-item pc-caption">
                        <label>Financeiro</label>
                        <i class="ti ti-dashboard"></i>
                    </li>

                   <li class="pc-item">
                        <a href="{{ route('cashier.index') }}" class="pc-link">
                            <span class="pc-micon">
                                <i class="ti ti-businessplan"></i>
                            </span>
                            <span class="pc-mtext">Caixa</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('nfe.index') }}" class="pc-link">
                            <span class="pc-micon">
                                <i class="ti ti-notes"></i>
                            </span>
                            <span class="pc-mtext">NF-e</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{route('nfe.nfeSettingsIndex')}}" class="pc-link">
                            <span class="pc-micon">
                                <i class="ti ti-settings"></i>
                            </span>
                            <span class="pc-mtext">Configurações da NF-e</span>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
