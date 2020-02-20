<?php

namespace srag\CustomInputGUIs\MultiSelectSearchNewInputGUI;

use ilDBConstants;
use ilObjUser;

/**
 * Class UsersAjaxAutoCompleteCtrl
 *
 * @package      srag\CustomInputGUIs\MultiSelectSearchNewInputGUI
 *
 * @author       studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class UsersAjaxAutoCompleteCtrl extends AbstractAjaxAutoCompleteCtrl
{

    /**
     * @inheritDoc
     */
    public function searchOptions(string $search = null) : array
    {
        return $this->formatUsers(ilObjUser::searchUsers($search));
    }


    /**
     * @inheritDoc
     */
    public function fillOptions(array $ids) : array
    {
        return $this->formatUsers(self::dic()->database()->fetchAll(self::dic()->database()->query('SELECT usr_id, firstname, lastname, login FROM usr_data WHERE ' . self::dic()
                ->database()
                ->in("usr_id", $ids, false, ilDBConstants::T_INTEGER))));
    }


    /**
     * @param array $users
     *
     * @return array
     */
    protected function formatUsers(array $users) : array
    {
        $formatted_users = [];

        foreach ($formatted_users as $user) {
            $users[$user["usr_id"]] = $user["firstname"] . " " . $user["lastname"] . " (" . $user["login"] . ")";
        }

        return $formatted_users;
    }
}
