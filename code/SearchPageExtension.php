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
    $ck = $this->owner->CacheKey('searchpage2', 'SearchPage');
    $ck = str_replace(' ', '_', $ck);
    $ck = str_replace(':', '_', $ck);
    $ck = str_replace('-', '_', $ck);

    $cache = SS_Cache::factory('searchpagecache');
    $searchPage = null;
    $cachekeyname = 'searchpageuri'.$this->owner->Locale.$ck;
    if(!($searchPage = unserialize($cache->load($cachekeyname)))) {
      $searchPage = SearchPage::get()->filter('ClassName','SearchPage')->first();
      $cache->save(serialize($searchPage), $cachekeyname);
    }
    return $searchPage;
  }

  function getAdvancedSearchPage() {
  	$ck = $this->owner->CacheKey('advancedsearchpage2', 'AdvancedSearchPage');
    $ck = str_replace(' ', '_', $ck);
    $ck = str_replace(':', '_', $ck);
    $ck = str_replace('-', '_', $ck);
    $cache = SS_Cache::factory('searchpagecache');
    $searchPage = null;
    $cachekeyname = 'searchpageuri'.$this->owner->Locale.$ck;
    if(!($searchPage = unserialize($cache->load($cachekeyname)))) {
      $searchPage = AdvancedSearchPage::get()->first();
      $cache->save(serialize($searchPage), $cachekeyname);
    }
    return $searchPage;
  }

}