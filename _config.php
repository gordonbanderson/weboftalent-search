<?php
// enable full text searching
FulltextSearchable::enable();

// Add the SearchpageURI method, which checks for the existence of a page of class SearchPage
Object::add_extension('Page_Controller', 'SearchPageExtension');

Object::add_extension('SearchPage_Controller', 'ZendSearchLuceneContentController');

?>