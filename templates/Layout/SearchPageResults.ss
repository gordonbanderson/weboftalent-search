$Content

<% if Form %>
$Form
<% end_if %>
</span><!--/txt-->

$SearchForm


<div class="searchResults">

<% if Results %>


<div class="resultsFound">
<% if AdvancedSearchPage %>
<div class="otherSearchLinks">
<% with AdvancedSearchPage %>
<a href="{$Link}?%2B=$Query">$Title</a>
<% end_with %>
</div>
<% end_if %>
Page $Results.CurrentPage of $Results.TotalPages &nbsp;($Results.Count <% _t('SearchPage.RESULTS_FOUND', ' results found') %> in $ElapsedTime seconds)
</div>
<% loop Results %>
<% include SearchResult %>
<% end_loop %>

    <% else %>

<div class="noResultsFound">
<% if AdvancedSearchPage %>
<div class="otherSearchLinks">
<% with AdvancedSearchPage %>
<a href="{$Link}?%2B=$Query">$Title</a>
<% end_with %>
</div>
Sorry, your search query did not return any results. 

 
<% end_if %>
  <% end_if %>
</div>




<% include SearchPagination %>

</div>




$PageComments