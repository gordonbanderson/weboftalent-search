<h1 class="head">$Title</h1>
$Content
<div>
$SearchForm
</div>

<script type="text/javascript">

JQ = jQuery.noConflict();

JQ(document).ready(function() {
  JQ('#SearchForm_SearchForm_Search').attr('placeholder', '<% _t('SearchPage.SEARCH_HINT', 'Enter a term to search the site') %>');
});
</script>
