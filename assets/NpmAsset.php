<?php 

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

class NpmAsset extends AssetBundle
{
    public $sourcePath = '@app/node_modules';
    public $js = [
        //'chart.js/auto/auto.js', // Ruta al archivo JS de la librería instalada
     // 'chart.js/dist/chart.umd.js', // Ruta al archivo UMD de Chart.js
        'aos/dist/aos.js',
        //['aos/dist/aos.js', View::POS_HEAD],
        //'sweetalert2/dist/sweetalert2.min.js',
        'axios/dist/axios.min.js',
        //'izitoast/dist/js/izitoast.min.js',
        'snowflakes/dist/snowflakes.min.js',
        ];
    public $css = [
        'aos/dist/aos.css',
      //  'sweetalert2/dist/sweetalert2.min.css',
       //  'izitoast/dist/css/izitoast.min.css',
        'bootstrap-icons/font/bootstrap-icons.min.css',
        'snowflakes/dist/snowflakes.min.css',
    ];
}