<?php

namespace srag\CustomInputGUIs;

/**
 * Trait CustomInputGUIsTrait
 *
 * @package srag\CustomInputGUIs
 */
trait CustomInputGUIsTrait
{

    /**
     * @return CustomInputGUIs
     */
    protected static final function customInputGUIs() : CustomInputGUIs
    {
        return CustomInputGUIs::getInstance();
    }
}
