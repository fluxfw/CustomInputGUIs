<?php

namespace srag\CustomInputGUIs\Waiter;

use ilTemplate;
use srag\DIC\DICTrait;

/**
 * Class Waiter
 * @package srag\CustomInputGUIs\Waiter
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
final class Waiter
{

    use DICTrait;

    /**
     * @var string
     */
    const TYPE_PERCENTAGE = "percentage";
    /**
     * @var string
     */
    const TYPE_WAITER = "waiter";
    /**
     * @var bool
     */
    protected static $init = false;


    /**
     * Waiter constructor
     */
    private function __construct(){}

    /**
     * @param string     $type
     * @param ilTemplate $ilTemplate
     */
    public static final function init(string $type, $ilTemplate = null)/*: void*/
    {
        $ilTemplate = $ilTemplate ?? self::dic()->ui()->mainTemplate();
        if (self::$init === false) {
            self::$init = true;

            $dir = __DIR__;
            $dir = "./" . substr($dir, strpos($dir, "/Customizing/") + 1);

            $ilTemplate->addCss($dir . "/css/waiter.css");

            $ilTemplate->addJavaScript($dir . "/js/waiter.min.js");
        }

        $ilTemplate->addOnLoadCode('il.waiter.init("' . $type . '");');
    }
}
