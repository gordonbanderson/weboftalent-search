<?php

class SearchPageExtension extends Extension {


 function getSearchPageURI() {

   
      $result = '';
      $searchPage = DataObject::get_one("SearchPage");
      if ($searchPage) {
        $result = $searchPage->AbsoluteLink();
      }

      return $result;
  }


  function getSearchPage() {
  	return DataObject::get_one("SearchPage");
  }

  function getAdvancedSearchPage() {
  	return DataObject::get_one("AdvancedSearchPage");
  }

}
?>