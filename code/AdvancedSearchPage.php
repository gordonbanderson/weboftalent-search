<?php
/**
* Only show a page with login when not logged in
*/
class AdvancedSearchPage extends SearchPage {

  static $defaults = array( 
    'ShowInMenus' => 0,
    //'ShowInSearch' => 0
  );
}




class AdvancedSearchPage_Controller extends SearchPage_Controller {

  private static $allowed_actions = array('AdvancedSearchForm');

  public function init() {
    parent::init();
    Requirements::css("weboftalent-search/css/search.css");
  }

  public function HideMenu() {
      return true;
    }
    
  /*
   Advanced search form components
  */
  function AdvancedSearchForm() {
    error_log("Show advanced search form");
    $searchText = isset($this->Query) ? $this->Query : 'Search';
    $form = new SearchAdvancedForm($this, "AdvancedSearchForm");//, null, $actions); //, $fields, $actions);
    $form->addExtraClass('inline');
    return $form;
  }

}

?>