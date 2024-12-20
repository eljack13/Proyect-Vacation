<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager; 
        //Apartado de Crear permisos 

        //ver vacaciones
        $vervacaciones = $auth->createPermission('ver-vacaciones'); 
        $vervacaciones->description = 'Ver vacaciones'; 
        $auth->add($vervacaciones);

        //crear vacaciones
        $crearvacaciones = $auth->createPermission('crear-vacaciones');
        $crearvacaciones->description = 'Crear vacaciones';
        $auth->add($crearvacaciones);

        $autorizar = $auth->createPermission('autorizar'); 
        $autorizar->description = "Permite autorizar las vacaciones"; 
        $auth->add($autorizar); 

        //apartado de roles 
        $Owner = $auth->createRole('Owner'); 
        $auth->add($Owner);

        $Admin = $auth->createRole('Admin');
        $auth->add($Admin);

        $User = $auth->createRole('User');
        $auth->add($User);

        $Jefe = $auth->createRole('Jefe Inmediato'); 
        $auth->add($Jefe); 

        //Asignar permisos a los roles 
      
        $auth->addChild($Owner, $vervacaciones);
        $auth->addChild($Owner, $crearvacaciones);
      
        $auth->addChild($Admin, $vervacaciones);
        $auth->addChild($Admin, $crearvacaciones);
    
        $auth->addChild($User, $vervacaciones);

        $auth->addChild($Jefe, $crearvacaciones); 
        $auth->addChild($Jefe, $autorizar);
        $auth->addChild($Jefe, $vervacaciones); 

        

    
    }
}
?> 