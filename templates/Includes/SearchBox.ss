<a name="searchBox"></a>
<div id="searchBox">
<h3 class="hide"><% _t('Page.SEARCH', 'Search') %></h3>


<% if SearchPageURI %>
<% cached 'header', Aggregate(SearchPage).Max(LastEdited) %>
<form action="{$SearchPageURI}SearchForm" class="form-search">
<input type="hidden" name="locale" value="$Locale"/>
<label class="accessibilityHidden" for="MainSearchBox">Search</label>
<% end_cached %>
<input name="Search" id="MainSearchBox" class="input-medium search-query" type="text" value="$Query" accesskey="3">


<button type="submit" class="btn"><i class="icon-search"></i></button>
</input>

</form>
<% else %>
<% _t('Page.SEARCH_UNAVAILABLE', 'Search Unavailable') %>
<% end_if %>
</div>