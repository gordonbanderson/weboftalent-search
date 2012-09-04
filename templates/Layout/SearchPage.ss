<h1 class="head">$Title</h1>
$Content

<h2> Search form here?</h2>
<div>
$SearchForm
</div>

<script type="text/javascript">

JQ = jQuery.noConflict();

JQ(document).ready(function() {
  JQ('#SearchForm_SearchForm_Search').val('<% _t('SearchPage.SEARCH_HINT', 'Enter a term to search the site asf') %>');
  JQ('#SearchForm_SearchForm_Search').jgTextHint();
  


});
</script>
