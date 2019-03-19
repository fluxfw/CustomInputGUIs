<?php

namespace srag\CustomInputGUIs\CommentsUI;

use ActiveRecord;
use arConnector;
use ilDateTime;
use srag\DIC\DICTrait;

/**
 * Class Comment
 *
 * @package srag\CustomInputGUIs\CommentsUI
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
abstract class Comment extends ActiveRecord {

	use DICTrait;
	/**
	 * @var string
	 *
	 * @abstract
	 */
	const TABLE_NAME = "";


	/**
	 * @return string
	 */
	public function getConnectorContainerName() {
		return static::TABLE_NAME;
	}


	/**
	 * @return string
	 *
	 * @deprecated
	 */
	public static function returnDbTableName() {
		return static::TABLE_NAME;
	}


	/**
	 * @var int
	 *
	 * @con_has_field   true
	 * @con_fieldtype   integer
	 * @con_length      8
	 * @con_is_notnull  true
	 * @con_is_primary  true
	 * @con_sequence    true
	 */
	protected $id;
	/**
	 * @var string
	 *
	 * @con_has_field   true
	 * @con_fieldtype   text
	 * @con_is_notnull  true
	 */
	protected $comment = "";
	/**
	 * @var int
	 *
	 * @con_has_field   true
	 * @con_fieldtype   integer
	 * @con_length      8
	 * @con_is_notnull  true
	 */
	protected $user_id;
	/**
	 * @var int
	 *
	 * @con_has_field   true
	 * @con_fieldtype   timestamp
	 * @con_is_notnull  true
	 */
	protected $timestamp;
	/**
	 * @var bool
	 *
	 * @con_has_field   true
	 * @con_fieldtype   integer
	 * @con_length      1
	 * @con_is_notnull  true
	 */
	protected $is_shared = false;


	/**
	 * Comment constructor
	 *
	 * @param int              $primary_key_value
	 * @param arConnector|null $connector
	 */
	public function __construct(/*int*/
		$primary_key_value = 0, /*?*/
		arConnector $connector = null) {
		parent::__construct($primary_key_value, $connector);
	}


	/**
	 * @param string $field_name
	 *
	 * @return mixed|null
	 */
	public function sleep(/*string*/
		$field_name) {
		$field_value = $this->{$field_name};

		switch ($field_name) {
			case "is_shared":
				return ($field_value ? 1 : 0);

			case "timestamp":
				return (new ilDateTime($field_value, IL_CAL_UNIX))->get(IL_CAL_DATETIME);

			default:
				return null;
		}
	}


	/**
	 * @param string $field_name
	 * @param mixed  $field_value
	 *
	 * @return mixed|null
	 */
	public function wakeUp(/*string*/
		$field_name, $field_value) {
		switch ($field_name) {
			case "is_shared":
				return boolval($field_value);

			case "timestamp":
				return (new ilDateTime($field_value, IL_CAL_DATETIME))->getUnixTime();

			default:
				return null;
		}
	}


	/**
	 * @return int
	 */
	public function getId(): int {
		return $this->id;
	}


	/**
	 * @param int $id
	 */
	public function setId(int $id)/*: void*/ {
		$this->id = $id;
	}


	/**
	 * @return string
	 */
	public function getComment(): string {
		return $this->comment;
	}


	/**
	 * @param string $comment
	 */
	public function setComment(string $comment)/*: void*/ {
		$this->comment = $comment;
	}


	/**
	 * @return int
	 */
	public function getUserId(): int {
		return $this->user_id;
	}


	/**
	 * @param int $user_id
	 */
	public function setUserId(int $user_id)/*: void*/ {
		$this->user_id = $user_id;
	}


	/**
	 * @return int
	 */
	public function getTimestamp(): int {
		return $this->timestamp;
	}


	/**
	 * @param int $timestamp
	 */
	public function setTimestamp(int $timestamp)/*: void*/ {
		$this->timestamp = $timestamp;
	}


	/**
	 * @return bool
	 */
	public function isShared(): bool {
		return $this->is_shared;
	}


	/**
	 * @param bool $is_shared
	 */
	public function setIsShared(bool $is_shared)/*: void*/ {
		$this->is_shared = $is_shared;
	}
}
