<div class="closeNav" id="close-nav" style="display: none"></div>
<header class="header" id="header">
    <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
    <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
</header>
<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div> 
            <a href="#" class="nav_logo"> 
                <i class='bx bx-layer nav_logo-icon'></i>
                <span class="nav_logo-name">BBBootstrap</span> 
            </a>
            <div class="nav_list"> 
                <a href="#" class="nav_link active"> 
                    <i class='bx bx-grid-alt nav_icon'></i> 
                    <span class="nav_name">Dashboard</span> 
                </a> 
                <a href="#" class="nav_link"> 
                    <i class='bx bx-cube nav_icon'></i> 
                    <span class="nav_name">Produtos</span> 
                </a> 
                <a href="#" class="nav_link"> 
                    <i class='bx bx-box nav_icon'></i>
                    <span class="nav_name">Estoques</span> 
                </a>
                <a href="#" class="nav_link"> 
                    <i class='bx bx-money nav_icon'></i>
                    <span class="nav_name">Caixa</span> 
                </a> 
                <a href="#" class="nav_link"> 
                    <i class='bx bxs-truck nav_icon'></i> 
                    <span class="nav_name">Frete</span> 
                </a> 
                <a href="{{route('app.order.index')}}" class="nav_link"> 
                    <i class='bx bx-list-ol nav_icon'></i> 
                    <span class="nav_name">Pedidos</span> 
                </a> 
            </div>
        </div>
        <a href="{{route('app.logoutApp')}}" class="nav_link"> 
            <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Sair</span> 
        </a>
    </nav>
</div>