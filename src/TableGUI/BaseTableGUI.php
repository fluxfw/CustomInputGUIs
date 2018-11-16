<?php

namespace srag\CustomInputGUIs\TableGUI;

use ilCSVWriter;
use ilExcel;
use ilTable2GUI;
use srag\DIC\DICTrait;

/**
 * Class BaseTableGUI
 *
 * @package srag\CustomInputGUIs\TableGUI
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
abstract class BaseTableGUI extends ilTable2GUI {

	use DICTrait;


	/**
	 * BaseTableGUI constructor
	 *
	 * @param object $parent
	 * @param string $parent_cmd
	 */
	public function __construct($parent, /*string*/
		$parent_cmd) {
		$this->initId();

		parent::__construct($parent, $parent_cmd);

		if (!(strpos($parent_cmd, "applyFilter") === 0
			|| strpos($parent_cmd, "resetFilter") === 0)) {
			$this->initTable();
		} else {
			// Speed up
			$this->initFilter();
		}
	}


	/**
	 *
	 */
	protected function initAction()/*: void*/ {
		$this->setFormAction(self::dic()->ctrl()->getFormAction($this->parent_obj));
	}


	/**
	 *
	 */
	protected abstract function initColumns()/*: void*/
	;


	/**
	 *
	 */
	protected abstract function initCommands()/*: void*/
	;


	/**
	 *
	 */
	protected abstract function initData()/*: void*/
	;


	/**
	 *
	 */
	protected abstract function initExport()/*: void*/
	;


	/**
	 *
	 */
	public /*abstract*/
	function initFilter()/*: void*/ {

	}


	/**
	 *
	 */
	protected abstract function initId()/*: void*/
	;


	/**
	 *
	 */
	protected abstract function initRowTemplate()/*: void*/
	;


	/**
	 *
	 */
	protected final function initTable()/*: void*/ {
		$this->initAction();

		$this->initTitle();

		$this->initFilter();

		$this->initData();

		$this->initColumns();

		$this->initExport();

		$this->initRowTemplate();

		$this->initCommands();
	}


	/**
	 *
	 */
	protected abstract function initTitle()/*: void*/
	;


	/**
	 *
	 */
	public /*abstract*/
	function fillHeader() {
		parent::fillHeader();
	}


	/**
	 * @param array $row
	 */
	protected /*abstract*/
	function fillRow(/*array*/
		$row) {

	}


	/**
	 *
	 */
	public /*abstract*/
	function fillFooter() {
		parent::fillFooter();
	}


	/**
	 * @param ilCSVWriter $csv
	 */
	protected /*abstract*/
	function fillHeaderCSV( /*ilCSVWriter*/
		$csv) {
		parent::fillHeaderCSV($csv);
	}


	/**
	 * @param ilCSVWriter $csv
	 * @param array       $result
	 */
	protected /*abstract*/
	function fillRowCSV(/*ilCSVWriter*/
		$csv, /*array*/
		$result) {
		parent::fillRowCSV($csv, $result);
	}


	/**
	 * @param ilExcel $excel
	 * @param int     $row
	 */
	protected /*abstract*/
	function fillHeaderExcel(ilExcel $excel, /*int*/
		&$row) {
		parent::fillHeaderExcel($excel, $row);
	}


	/**
	 * @param ilExcel $excel
	 * @param int     $row
	 * @param array   $result
	 */
	protected /*abstract*/
	function fillRowExcel(ilExcel $excel, /*int*/
		&$row, /*array*/
		$result) {
		parent::fillRowExcel($excel, $row, $result);
	}
}
