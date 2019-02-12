<?php

namespace srag\Plugins\SrLearningProgressPDBlock\Access;

use ilLearningProgressBaseGUI;
use ilLPObjSettings;
use ilLPStatus;
use ilObjectLP;
use ilObjUser;
use ilSrLearningProgressPDBlockPlugin;
use srag\DIC\SrLearningProgressPDBlock\DICTrait;
use srag\Plugins\SrLearningProgressPDBlock\Utils\SrLearningProgressPDBlockTrait;

/**
 * Class LearningProgress
 *
 * @package srag\Plugins\SrLearningProgressPDBlock\Access
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class LearningProgress {

	use SrLearningProgressPDBlockTrait;
	use DICTrait;
	const PLUGIN_CLASS_NAME = ilSrLearningProgressPDBlockPlugin::class;
	const LP_STATUS_COLOR = [
		ilLPStatus::LP_STATUS_NOT_ATTEMPTED_NUM => "#DDDDDD",
		ilLPStatus::LP_STATUS_IN_PROGRESS_NUM => "#F6D842",
		ilLPStatus::LP_STATUS_COMPLETED_NUM => "#BDCF32",
		ilLPStatus::LP_STATUS_FAILED => "#B06060"
	];
	/**
	 * @var self[]
	 */
	protected static $instances = [];


	/**
	 * @param ilObjUser $user
	 *
	 * @return self
	 */
	public static function getInstance(ilObjUser $user): self {
		if (!isset(self::$instances[$user->getId()])) {
			self::$instances[$user->getId()] = new self($user);
		}

		return self::$instances[$user->getId()];
	}


	/**
	 * @var ilObjUser
	 */
	protected $user;


	/**
	 * LearningProgress constructor
	 *
	 * @param ilObjUser $user
	 */
	private function __construct(ilObjUser $user) {
		$this->user = $user;
	}


	/**
	 * @param int $obj_id
	 *
	 * @return bool
	 */
	public function enabled(int $obj_id): bool {
		$result = self::dic()->database()->queryF('SELECT u_mode FROM ut_lp_settings WHERE obj_id=%s', [ "integer" ], [ $obj_id ]);

		if (($row = $result->fetchAssoc()) !== false) {
			return (intval($row["u_mode"]) === ilLPObjSettings::LP_MODE_COLLECTION);
		} else {
			return false;
		}
	}

}
