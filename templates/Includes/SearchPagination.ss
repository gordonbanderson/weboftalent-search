<% if Results.MoreThanOnePage %>
    <div class="pagination pagination-centered">
      <ul>
      
        <li class="prev <% if Results.NotFirstPage %><% else %>disabled<% end_if %>"><a href="$Results.PrevLink" title="<% _t('SearchPage.PREVIOUS_PAGE', 'View the previous page') %>"><% _t('SearchPage.PREV
IOUS', 'Prev') %></a</li>
        <% loop Results.Pages(8) %>
          <% if CurrentBool %>
            <li class="active"><a href="$Link" title="View page number $PageNum">$PageNum</a></li>
          <% else %>
            <li><a href="$Link" title="View page number $PageNum">$PageNum</a></li>
          <% end_if %>
        <% end_loop %>

        <li class="next <% if Results.NotLastPage %><% else %>disabled<% end_if %>">
        <a  href="$Results.NextLink" title="<% _t('SearchPage.NEXT_PAGE', 'View the next page') %>">
        <% _t('SearchPage.NEXT', 'Next') %></a>
</li>

             </ul>

    </div>
  <% end_if %>

<div class="clearall">&nbsp;</div>