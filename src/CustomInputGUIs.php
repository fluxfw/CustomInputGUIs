<?php

namespace srag\CustomInputGUIs;

use srag\CustomInputGUIs\ProgressMeter\Implementation\Factory as ProgressMeterFactory;
use srag\DIC\DICTrait;

/**
 * Class CustomInputGUIs
 *
 * @package srag\CustomInputGUIs
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 *
 * @internal
 */
final class CustomInputGUIs {

	use DICTrait;
	/**
	 * @var self
	 */
	protected static $instance = NULL;


	/**
	 * @return self
	 */
	public static function getInstance(): self {
		if (self::$instance === NULL) {
			self::$instance = new self();
		}

		return self::$instance;
	}


	/**
	 * @return ProgressMeterFactory
	 */
	public function progressMeter() {
		return new ProgressMeterFactory();
	}
}
