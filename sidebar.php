<aside class="sidebar">
        <nav class="sidebar-nav">
            <a href="dashboard.php">  
            <div class="nav-item <?php if (isset($page_name) && $page_name === 'dashboard'){ 'nav-item-active';} ?>">
                <i class="bxf bx-dashboard"></i>
                <span>Dashboard</span>
            </div>
            </a>
            <a href="stock.php">
            <div class="nav-item <?php if (isset($page_name) && $page_name === 'stock'){ 'nav-item-active';} ?>">
                <i class="bxf bx-archive-alt"></i>
                <span>Inventaire</span>
            </div>
            </a>
            <a href="historique.php">
            <div class="nav-item <?php if (isset($page_name) && $page_name === 'historique'){ 'nav-item-active';} ?>">
                <i class="bxf bx-history" ></i>
                <span>Historique</span>
            </div>
            </a>
        </nav>  
        
        <div class="sidebar-footer">
            <a href="help.php">
                <div class="footer-item">
                <span class="material-symbols-outlined">help</span>
                <span>Centre D'aide</span>
                </div>
            </a>
            <a href="logout.php">
                <div class="footer-item footer-item-logout">
                <span class="material-symbols-outlined">logout</span>
                <span>Déconnexion</span>
                </div>
            </a>
        </div>
    </aside>