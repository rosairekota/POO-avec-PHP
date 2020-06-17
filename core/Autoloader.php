<?php

namespace Core;

/**
 * @class classe permmettant d'autoloader nos classe dynamiquement
 */
class Autoloader
{
    /**
     * @function :permet de generer un autoloder
     */
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoloader']);

        //__CLASS__ : permet de generer le nom de la classe dynamiquemet =__FILE__
    }

    public static function autoloader($class_name)
    {
        /*
         On met une condutionpour que celle les classes qui seront incluses soit celle de notre NAMESPACE 
         PAS LES CLASSES EXTERNES DE AUTRES LIBRAIRIE
         */
        if (strpos($class_name, __NAMESPACE__ . '\\') == 0) {

            /*
         * on genere le NAMESPACCE DYNAMIQUEMENT 
         * ON REMPLACE LE \\ par du vide ...
         */
            $class_name = str_replace(__NAMESPACE__ . '\\', '', $class_name);
            $class_name = str_replace('\\', '/', $class_name);

            // on inclus nos classe
            require(__DIR__ . '/' . $class_name . '.php');
        }
    }
}
