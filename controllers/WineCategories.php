<?php namespace Stone\FoodMenu\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

use Stone\FoodMenu\Models\WineCategory;

/**
 * Wine Categories Back-end Controller
 */
class WineCategories extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Stone.FoodMenu', 'foodmenu', 'winecategories');
    }

    /** Delete items from the list. Ajax call **/
    public function onDelete() {

        /** Check if this is even set **/
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {
            /** cycle through each id **/
            foreach ($checkedIds as $objectId) {

                /** Check if there's an object actually related to this id
                 * Make sure you replace MODELNAME with your own model you wish to delete from.
                 **/
                if (!$object = WineCategory::find($objectId))
                    continue; /** Screw this, next! **/
                /** Valid item, delete it **/
                $object->delete();
            }

        }

        /** Return the new contents of the list, so the user will feel as if
         * they actually deleted something
         **/
        return $this->listRefresh();
    }
}