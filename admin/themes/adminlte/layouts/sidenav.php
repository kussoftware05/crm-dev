<?php 
use yii\widgets\Menu;
use yii\helpers\Url;

?>
<style>
.dot {
    height: 8px;
    width: 8px;
    background-color: #0ef731;
    border-radius: 50%;
    display: inline-block;
}

.u_b_t{
    border-top: 1px solid #4f5962;
}
</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
    <img src="<?php echo Url::to(['/web/images/dev.jpg']); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
        style="opacity:0.8">
    <span class="brand-text font-weight-light">CRM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            <img src="<?php echo Url::to(['/web/images/dev.jpg']); ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo (Yii::$app->user->identity) ? Yii::$app->user->identity->username : 'Admin'  ?> &nbsp;&nbsp; 
                    <span class="dot"></span>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            
                <li class="nav-item">
                    <a href="<?php echo Url::to(['/']); ?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Dashboard
                        <span class="right badge badge-danger">New</span>
                    </p>
                    </a>
                </li>

                <div class="user-panel u_b_t">
                    <li class="nav-header">Business Management</li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                        <i class="fa fa-address-card" aria-hidden="true"></i>
                        <p>
                            Business
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo Url::to(['/business/create']); ?>" class="nav-link"> 
                            <i class="far fa-circle nav-icon"></i>
                            <p>Create</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=" <?php echo Url::to(['/business/index']); ?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Business List</p>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="user-panel u_b_t">
                    <li class="nav-header">Shop</li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                        <p>
                            Products
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href=" <?php echo Url::to(['/product/create']); ?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Create</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo Url::to(['/product/index ']); ?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Product List</p>
                            </a>
                        </li>
                    </ul>
                    <li class="nav-item">
                        <a href="<?php echo Url::to(['/product-category/index ']); ?>" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>Product Category</p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Orders 
                            <i class="right fas fa-angle-left"></i>
                            <span class="right badge badge-primary">3 New</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href=" <?php echo Url::to(['/order/create']); ?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Create</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo Url::to(['/order/index ']); ?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Order List</p>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="user-panel u_b_t">
                    <li class="nav-header">Content</li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Blogs
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo Url::to(['/blog/create']); ?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Create</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo Url::to(['/blog/index']); ?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Blog List</p>
                            </a>
                        </li>
                    </ul>
                    <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Pages
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo Url::to(['/page/create']); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo Url::to(['/page/index']); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pages List</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Slider
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo Url::to(['/slider/create']); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo Url::to(['/slider/index']); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Slider List</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </div>

                <div class="user-panel u_b_t">
                    <li class="nav-header">User Management</li>
                    <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                User
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href=" <?php echo Url::to(['/user/create']); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo Url::to(['/user/index']); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User List</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </div>

                <li class="nav-item">
                    <a href="<?php echo Url::to(['/settings/index']); ?>" class="nav-link">
                    <i class="fa fa-wrench" aria-hidden="true"></i>
                    <p>Settings</p>
                    </a>
                </li>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>