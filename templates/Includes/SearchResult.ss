<% cached 'BasicSearchResult', ID, LastEdited %>
  <div class="searchResult">
  <a href="$Link"><h3>$Title</h3></a>
  <% if Content %><p class="summary">$Content.Summary(30)</p><% end_if %>
  <div class="searchFooter">
  <% if ClassName = Link %>
$LoadLink
  <% else %>
$AbsoluteLink
  <% end_if %>
  - $LastEdited.Format(d/m/y)
  </div>
  </div>    
  <% end_cached %>