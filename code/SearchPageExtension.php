<?php

class SearchPageExtension extends Extension {


 function getSearchPageURI() {
      $result = '';
      // we need to check the classname otherwise a child class such as AdvancedSearchPage can be returned
      $searchPage = DataObject::get_one("SearchPage","ClassName = 'SearchPage'");
      error_log("SEARCH PAGE:".$searchPage);
      if ($searchPage) {
        $result = $searchPage->AbsoluteLink();
      }

      return $result;
  }


  function getSearchPage() {
    // we need to check the classname otherwise a child class such as AdvancedSearchPage can be returned
    return DataObject::get_one("SearchPage","ClassName = 'SearchPage'");
  }

  function getAdvancedSearchPage() {
  	return DataObject::get_one("AdvancedSearchPage");
  }

}
?>