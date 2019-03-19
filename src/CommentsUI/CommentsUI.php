<?php

namespace srag\CustomInputGUIs\CommentsUI;

use srag\DIC\DICTrait;

/**
 * Class CommentsUI
 *
 * @package srag\CustomInputGUIs\CommentsUI
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
final class CommentsUI {

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
	 * CommentsUI constructor
	 */
	public function __construct() {

	}
}
