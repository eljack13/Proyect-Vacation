<?php

/** @var yii\web\View $this */

/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use app\assets\NpmAsset;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
NpmAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <style>
        .colorcito {
            background: linear-gradient(135deg, #f5f7fa 100%, #c3cfe2 100%);
        }

        .color2 {
            background: linear-gradient(135deg, #002544  100%, #c3cfe2 100%);
        }

        .navbar-nav {
            width: 100%;
            display: flex;
            align-items: center;
        }

        .login-item {
            margin-left: auto !important;
        }

        .nav-link.logout {
            padding: 0.5rem 1rem;
            color: rgba(255, 255, 255, 0.85) !important;
            transition: color 0.3s ease;
        }

        .nav-link.logout:hover {
            color: white !important;
        }
    </style>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <title><?= Html::encode($this->title) ?></title>
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <?php $this->head() ?>
    </head>
    <body class="d-flex flex-column h-100 colorcito">
    <?php $this->beginBody() ?>
    <header id="header">
        <?php
        NavBar::begin([
            'brandLabel' => '<span class="mdi mdi-vacuum-outline"></span>',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => ['class' => 'navbar-expand navbar-dark fixed-top shadow bg-dark color2'],
        ]);

        $regularItems = [
            ['label' => '<i class="mdi mdi-file-document-multiple-outline"></i>', 'url' => ['/tbl-sata/index'], 'encode' => false],
            ['label' => '<i class="mdi mdi-account-plus"></i>', 'url' => ['/tblregistropersonal/index'], 'encode' => false],
            ['label' => '<i class="mdi mdi-account-multiple"></i>', 'url' => ['/tblregistropersonal/list'], 'encode' => false],
            ['label' => '<i class="mdi mdi-monitor-dashboard"></i>', 'url' => ['/tbl-personal/dashboard'], 'encode' => false],
            
           
        ];
      
        if (Yii::$app->user->isGuest) {
            $regularItems[] = [
              
                'label' => '<i class="mdi mdi-account-arrow-right"></i>', 
                'url' => ['/site/login'], 
                'options' => ['class' => 'login-item'], 
                'encode' => false
            ];
        } else {
            $regularItems[] = [
                
                'label' => '<i class="mdi mdi-logout"></i>', 
                'url' => ['/site/logout'], 
                'linkOptions' => [
                    'data-method' => 'post',
                    'class' => 'logout-link'
                ],
                'options' => ['class' => 'login-item logout'],
                'encode' => false
            ];
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav nav-pills'],
            'items' => $regularItems
        ]);

        NavBar::end();
        ?>
    </header>

    <main id="main" class="flex-shrink-0" role="main">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => $this->params['breadcrumbs'] ?? [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>

            <footer id="footer" class="mt-auto py-3 bg-light">
            </footer>

            <?php $this->endBody() ?>
    </body>
    </html>

    <script src="assets/libraries/snowflakeJS-master/snowflake.min.js"></script>
    
    <?php if(Yii::$app->params['activateSnowflakes']) : ?>
    <script>
        // Codigo para la animaciòn de copos de nieve 
        //activar en diciembre
        //se modifica desde el archivo params.php
      snowflakes.init();

      const snowflake = new SnowflakeJs(
        frames=30,
         count=800, 
         lifetime=200, 
         maxSpeed=500, 
         maxSize=5, 
         color='#fff', 
         shadow=true, 
         shadowColor='#fff', 
         shadowBlur=0, 
         zIndex=9999);
      
      snowflake.init();
    </script>
    <?php endif; ?>

<?php $this->endPage() ?>