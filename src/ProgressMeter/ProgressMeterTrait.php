<?php

namespace srag\CustomInputGUIs\ProgressMeter;

use srag\CustomInputGUIs\ProgressMeter\Implementation\Factory;

/**
 * Trait ProgressMeterTrait
 *
 * @package srag\CustomInputGUIs\ProgressMeter
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
trait ProgressMeterTrait {

	/**
	 * @return Factory
	 */
	protected static final function progressMeter() {
		return new Factory();
	}
}
