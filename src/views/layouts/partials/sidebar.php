<?php
/**
 * @var $assetDir string
 * @var $this \app\components\web\View
 */

use hail812\adminlte\widgets\Menu;
use yii\helpers\Url;

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Url::home()?>" class="brand-link text-center">
        <i class="fa-2x fas fa-university"></i>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="p-2">
                <a href="<?=Url::to(['user/profile'])?>" class="d-block">
                    <i class="fa fa-user-circle img-circle text-white" ></i>
                    <?=Yii::$app->getUser()->getIdentity()->username?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo Menu::widget([
                'items' => $this->getMenuItems()
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
