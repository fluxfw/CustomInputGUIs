<?php

namespace srag\CustomInputGUIs\InputGUIWrapperUIInputComponent;

use ILIAS\Refinery\Constraint;
use ILIAS\Refinery\Custom\Constraint as CustomConstraint;

/**
 * Class InputGUIWrapperConstraint
 *
 * @package srag\CustomInputGUIs\InputGUIWrapperUIInputComponent
 */
class InputGUIWrapperConstraint extends CustomConstraint implements Constraint
{

    use InputGUIWrapperConstraintTrait;
}
