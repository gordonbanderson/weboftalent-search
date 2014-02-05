<?php

class SearchPageExtension extends Extension {


 function getSearchPageURI() {
      $result = '';

      $searchPage = $this->getSearchPage();

      if ($searchPage) {
        $result = $searchPage->AbsoluteLink();
      }

      return $result;
  }


  function getSearchPage() {
    $ck = $this->owner->CacheKey('searchpage', 'SearchPage');
    $ck = str_replace(' ', '_', $ck);
    $ck = str_replace(':', '_', $ck);
    $ck = str_replace('-', '_', $ck);

    $cache = SS_Cache::factory('searchpagecache');
    $searchPage = null;
    $cachekeyname = 'searchpageuri'.$this->owner->Locale.$ck;
    if(!($searchPage = unserialize($cache->load($cachekeyname)))) {
      $searchPage = DataObject::get_one("SearchPage","ClassName = 'SearchPage'");
      $cache->save(serialize($searchPage), $cachekeyname);
    }
    return $searchPage;
  }

  function getAdvancedSearchPage() {
  	$ck = $this->owner->CacheKey('advancedsearchpage', 'AdvancedSearchPage');
    $ck = str_replace(' ', '_', $ck);
    $ck = str_replace(':', '_', $ck);
    $ck = str_replace('-', '_', $ck);
    $cache = SS_Cache::factory('searchpagecache');
    $searchPage = null;
    $cachekeyname = 'searchpageuri'.$this->owner->Locale.$ck;
    if(!($searchPage = unserialize($cache->load($cachekeyname)))) {
      $searchPage = DataObject::get_one("AdvancedSearchPage","ClassName = 'SearchPage'");
      $cache->save(serialize($searchPage), $cachekeyname);
    }
    return $searchPage;
  }

}