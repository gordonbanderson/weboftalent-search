<?php
/**
* Only show a page with login when not logged in
*/
class SearchPage extends Page { 
  static $defaults = array( 
      'ShowInMenus' => 0,
      //'ShowInSearch' => 0
    ); 
}


class SearchPage_Controller extends Page_Controller {

  public function init() {
    parent::init();
    Requirements::css("weboftalent-search/css/search.css");
  }


 public function HideMenu() {
    	return true;
    }

  public function HideBreadCrumbs() {
    return true;
  }


/* Results from search submission */
  function results($data, $form) {
      $startTime = microtime(true);

    


      error_log("Search results:".get_class($form));
      $formResultsTemplate = 'SearchPageResults';

      if (get_class($form) == 'SearchAdvancedForm') {
        error_log("**** RENDER ADVANCED SEARCH RESULTS ****");
        $formResultsTemplate = 'AdvancedSearchPageResults';


        $form->loadDataFrom( $data); 

        $data= array(
              'Results' => $form->getResults(),
              'Query' => $form->getSearchQuery(),
              'Title' => $this->Title,
              'quote' => $data['quote'],
              'PageNumber' => 4

            );


            $this->Query = $form->getSearchQuery();
 
      } else {
        // basic form
            $data = array(
              'Results' => $form->getResults(),
              'Query' => $form->getSearchQuery(),
              'Title' => $this->Title,
              'PageNumber' => 4

            );


            $this->Query = $form->getSearchQuery();

      }

      $endTime = microtime(true);

      $elapsed = round(100*($endTime-$startTime))/100;
      $data['ElapsedTime'] = $elapsed;

      error_log("about to render");


      return $this->customise($data)->renderWith(array($formResultsTemplate, 'Page'));
  }
  


  /*
  Search form components
  */
  function SearchForm() {
    error_log("Show search form");

    // show search term or empty text
    $searchText = isset($this->Query) ? $this->Query : '';

    $tf = new TextField("Search", "", $searchText);
    $tf->addExtraClass('span6');


    
    $fields = new FieldList(
      $tf
    );

    $fa = new FormAction('results', _t('SearchPage.SEARCH', 'Search'));

    // for bootstrap
    $fa->useButtonTag = true;
    $fa->addExtraClass('btn');
    $fa->addExtraClass('btn-primary');
      
    $actions = new FieldList(
        $fa
      );


    $requiredFields = new RequiredFields(); 
    //$requiredFields->set_javascript_validation_handler('none');

        
    $form = new SearchForm($this, "SearchForm", $fields, $actions, $requiredFields);
    $form->setTemplate('HorizontalForm');

    $form->addExtraClass('form-inline');

    $form->Horizontal = true;

    return $form;
  }


  function forTemplate() {
      return $this->renderWith(array(
         $this->class,
         'SearchForm'
      ));
   }




}

?>