<?php

namespace srag\CustomInputGUIs\NumberInputGUI;

use ilNumberInputGUI;
use ilTableFilterItem;
use ilToolbarItem;
use srag\DIC\DICTrait;

/**
 * Class NumberInputGUI
 *
 * @package srag\CustomInputGUIs\NumberInputGUI
 */
class NumberInputGUI extends ilNumberInputGUI implements ilTableFilterItem, ilToolbarItem
{

    use DICTrait;

    /**
     * @inheritDoc
     */
    public function getTableFilterHTML() : string
    {
        return $this->render();
    }


    /**
     * @inheritDoc
     */
    public function getToolbarHTML() : string
    {
        return $this->render();
    }
}
