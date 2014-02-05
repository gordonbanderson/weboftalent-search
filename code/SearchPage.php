<?php
/**
* Only show a page with login when not logged in
*/
class SearchPage extends Page { 
  static $defaults = array( 
      'ShowInMenus' => 0,
      //'ShowInSearch' => 0
    );
   private static $icon = 'weboftalent-search/icons/search.png'; 
}


class SearchPage_Controller extends Page_Controller {

  private static $allowed_actions = array('SearchForm', 'resuts');

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


      return $this->customise($data)->renderWith(array($formResultsTemplate, 'Page'));
  }
  


  /*
  Search form components
  */
  function SearchForm() {

    // show search term or empty text
    $searchText = isset($this->Query) ? $this->Query : '';

    $tf = new TextField("Search", "", $searchText);
    $tf->addExtraClass('small-9 medium-10 large-11 columns');

    $fields = new FieldList(
      $tf
    );

    $fa = new FormAction('results', _t('SearchPage.SEARCH', 'Search'));

    // for zurb
    $fa->useButtonTag = true;
    $fa->addExtraClass('button tiny small-3 medium-2 large-1 columns');
   // $fa->addExtraClass('btn-primary');
      
    $actions = new FieldList(
        $fa
      );


    $requiredFields = new RequiredFields(); 
    //$requiredFields->set_javascript_validation_handler('none');

        
    $form = new FoundationSearchForm($this, "SearchForm", $fields, $actions, $requiredFields);
   // $form->setTemplate('HorizontalForm');

    $form->addExtraClass('inline');

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