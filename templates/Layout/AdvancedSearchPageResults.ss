<h1 class="head">$Title</h1>
$Content


$AdvancedSearchForm




<div class="searchResults">

<% if Results %>
<div class="resultsFound">
<% if SearchPage %>
<div class="otherSearchLinks">
<% control SearchPage %>
<a href="{$Link}?%2B=$Query">$Title</a>
<% end_control %>
</div>
<% end_if %>

$Results.TotalItems <% _t('SearchPage.RESULTS_FOUND', ' results found') %>
</div>
<% control Results %>
  <% include SearchResult %>
<% end_control %>
 <% else %>

<div class="noResultsFound">
<% if SearchPage %>
<div class="otherSearchLinks">
<% control SearchPage %>
<a href="{$Link}?%2B=$Query">$Title</a>
<% end_control %>
</div>
<% end_if %>

  <% end_if %>
  Sorry, your search query did not return any results. 
</div>




<% include SearchPagination %>







</div>
