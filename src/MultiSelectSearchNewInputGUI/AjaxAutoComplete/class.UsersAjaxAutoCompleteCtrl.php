<?php

namespace srag\CustomInputGUIs\MultiSelectSearchNewInputGUI\AjaxAutoComplete;

use ilObjUser;

/**
 * Class UsersAjaxAutoCompleteCtrl
 *
 * @package srag\CustomInputGUIs\MultiSelectSearchNewInputGUI\AjaxAutoComplete
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class UsersAjaxAutoCompleteCtrl extends AbstractAjaxAutoCompleteCtrl
{

    /**
     * @inheritDoc
     */
    public function searchOptions(string $search = null) : array
    {
        $users = [];

        foreach (ilObjUser::searchUsers($search) as $user) {
            $users[$user["usr_id"]] = $user["firstname"] . " " . $user["lastname"] . " (" . $user["login"] . ")";
        }

        return $users;
    }


    /**
     * @inheritDoc
     */
    public function fillOptions(array $ids) : array
    {
        // TODO: Implement fillOptions() method.
    }
}
