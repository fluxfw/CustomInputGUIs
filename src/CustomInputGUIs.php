<?php

namespace srag\CustomInputGUIs;

use ILIAS\UI\Implementation\Component\Chart\ProgressMeter\Factory as ProgressMeterFactoryCore;
use srag\CustomInputGUIs\CommentsUI\CommentsUI;
use srag\CustomInputGUIs\LearningProgressPieUI\LearningProgressPieUI;
use srag\CustomInputGUIs\ProgressMeter\Implementation\Factory as ProgressMeterFactory;
use srag\CustomInputGUIs\ViewControlModeUI\ViewControlModeUI;
use srag\DIC\DICTrait;

/**
 * Class CustomInputGUIs
 *
 * @package srag\CustomInputGUIs
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
final class CustomInputGUIs {

	use DICTrait;
	/**
	 * @var self
	 */
	protected static $instance = null;


	/**
	 * @return self
	 */
	public static function getInstance(): self {
		if (self::$instance === null) {
			self::$instance = new self();
		}

		return self::$instance;
	}


	/**
	 * CustomInputGUIs constructor
	 */
	public function __construct() {

	}


	/**
	 * @return CommentsUI
	 */
	public function comments() {
		return new CommentsUI();
	}


	/**
	 * @return LearningProgressPieUI
	 */
	public function learningProgressPie() {
		return new LearningProgressPieUI();
	}


	/**
	 * @return ProgressMeterFactoryCore|ProgressMeterFactory
	 *
	 * @since ILIAS 5.4
	 */
	public function progressMeter() {
		if (self::version()->is54()) {
			return new ProgressMeterFactoryCore();
		} else {
			return new ProgressMeterFactory();
		}
	}


	/**
	 * @return ViewControlModeUI
	 */
	public function viewControlMode() {
		return new ViewControlModeUI();
	}
}
