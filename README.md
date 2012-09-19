##Functionality
* Addition of a Search Page with paginated results
* Addition of an Advanced Search Page with paginated results
* Search URLs are consistent, e.g. /search?Search=module

## Installation
    git clone git://github.com/gordonbanderson/weboftalent-search.git
    cd weboftalent-search
    git checkout stable24

The name of the output directory does not matter

## Content Types

* SearchPage - Displays a search form and if a query was made search results for a simple search
* AdvancedSearchPage - Displays an advanced search form and if a query was made render the results

## Usage

### Content Types

Recommened approach is to create a page of type 'SearchPage' at the root of your site and hide it from the menu.  Then create an 'AdvancedSearchPage' under the search page, and do the same.  This creates SEO friendly URLs of the likes of /search and /search/advanced.  This is of course only a suggestion

### Templates
Depending on where you want the search box, add the following in your template:

	<% include SearchBox %>

You can of course customize this in your own theme.

## Silverstripe Version Compatibility
2.4 only (tested with 2.4.5+) - stable24 branch