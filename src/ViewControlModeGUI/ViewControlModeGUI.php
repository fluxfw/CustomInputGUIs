<?php

namespace srag\CustomInputGUIs\ViewControlModeGUI;

use ilSession;
use srag\DIC\DICTrait;

/**
 * Class ViewControlModeGUI
 *
 * @package srag\CustomInputGUIs\ViewControlModeGUI
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class ViewControlModeGUI {

	const CMD_HANDLE_BUTTONS = "ViewControlModeGUIHandleButtons";
	use DICTrait;
	/**
	 * @var array
	 */
	protected $buttons = [];
	/**
	 * @var string
	 */
	protected $default_active_id = "";
	/**
	 * @var string
	 */
	protected $id = "";
	/**
	 * @var string
	 */
	protected $link = "";


	/**
	 * ViewControlModeGUI constructor
	 */
	public function __construct() {

	}


	/**
	 * @param array $buttons
	 *
	 * @return self
	 */
	public function withButtons(array $buttons): self {
		$this->buttons = $buttons;

		return $this;
	}


	/**
	 * @param string $default_active_id
	 *
	 * @return self
	 */
	public function withDefaultActiveId(string $default_active_id): self {
		$this->default_active_id = $default_active_id;

		return $this;
	}


	/**
	 * @param string $id
	 *
	 * @return self
	 */
	public function withId(string $id): self {
		$this->id = $id;

		return $this;
	}


	/**
	 * @param string $link
	 *
	 * @return self
	 */
	public function withLink(string $link): self {
		$this->link = $link;

		return $this;
	}


	/**
	 * @return string
	 */
	public function render(): string {
		$actions = [];

		foreach ($this->buttons as $id => $txt) {
			$actions[$txt] = $this->link . "&" . self::CMD_HANDLE_BUTTONS . "=" . $id;
		}

		return self::output()->getHTML(self::dic()->ui()->factory()->viewControl()->mode($actions, "")
			->withActive($this->buttons[$this->getActiveId()]));
	}


	/**
	 *
	 */
	public function handleButtons() {
		$active_id = filter_input(INPUT_GET, self::CMD_HANDLE_BUTTONS);

		ilSession::set(self::CMD_HANDLE_BUTTONS . "_" . $this->id, $active_id);
	}


	/**
	 * @return string
	 */
	public function getActiveId(): string {
		$active_id = ilSession::get(self::CMD_HANDLE_BUTTONS . "_" . $this->id);

		if ($active_id === NULL || !isset($this->buttons[$active_id])) {
			return $active_id = $this->default_active_id;
		}
self::dic()->ctrl()->setReturn()
		return $active_id;
	}
}
