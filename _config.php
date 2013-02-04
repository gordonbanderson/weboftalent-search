<?php
// enable full text searching
FulltextSearchable::enable();

// Add the SearchpageURI method, which checks for the existence of a page of class SearchPage
Page_Controller::add_extension('SearchPageExtension');

SearchPage_Controller::add_extension( 'ZendSearchLuceneContentController');

?>