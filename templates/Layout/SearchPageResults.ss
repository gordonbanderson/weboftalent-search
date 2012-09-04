$Content

<% if Form %>
$Form
<% end_if %>
</span><!--/txt-->

$SearchForm



<% if Results %>
<div class="searchResults">


<div class="resultsFound">$Results.TotalItems <% _t('SearchPage.RESULTS_FOUND', ' results found') %></div>
<% control Results %>
  <div class="searchResult">
  <a href="$Link">$Title</a>
  <% if Content %><div class="summary">$Content.Summary(30)</div><% end_if %>
  <div class="searchFooter">
  <% if ClassName = Link %>
$LoadLink
  <% else %>
$AbsoluteLink
  <% end_if %>
  - $LastEdited.Format(d/m/y)
  </div>
  </div>    
<% end_control %>
</div>

    <% else %>
    <p>Sorry, your search query did not return any results.</p>
  <% end_if %>





<% if Results.MoreThanOnePage %>
    <div class="pageNumbers">
      
      <% if Results.NotFirstPage %>
        <a class="prev" href="$Results.PrevLink" title="<% _t('SearchPage.PREVIOUS_PAGE', 'View the previous page') %>"><% _t('SearchPage.PREV
IOUS', 'Prev') %></a>
      <% end_if %>
      <span>
        <% control Results.Pages %>
          <% if CurrentBool %>
            $PageNum
          <% else %>
            <a href="$Link" title="View page number $PageNum">$PageNum</a>
          <% end_if %>
        <% end_control %>
      </span>

      <% if Results.NotLastPage %>
        <a class="next" href="$Results.NextLink" title="<% _t('SearchPage.NEXT_PAGE', 'View the next page') %>"><% _t('SearchPage.NEXT', 'Next
') %></a>
      <% end_if %>
    </div>
  <% end_if %>


</div>

$PageComments