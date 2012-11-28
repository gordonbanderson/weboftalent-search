<?php
/**
 * More advanced search form
 * @package sapphire
 * @subpackage search
 */
class SearchAdvancedForm extends SearchForm {

	public static $fieldCssClasses = 'span11';
	public static $buttonCssClasses = 'btn btn-primary';


	protected $classesToSearch = array(
		"SiteTree", "File"
	);



	public static function setFieldCSSClasses($cssClasses) {
		self::$fieldCssClasses = $cssClasses;
	}

	public static function setButtonCSSClasses($cssClasses) {
		self::$buttonCssClasses = $cssClasses;
	}
	
	
	/**
	 * the constructor of a Simple/basic SearchForm
	 */
	function __construct($controller, $name, $fields = null, $actions = null) {
		error_log("Advanced search form - GBA");

/*
		if($this->owner->request) {
			$searchText = $this->owner->request->getVar('Search');
		}

		$fields = new FieldList(
			new TextField('Search', false, $searchText)
		);
*/

		//FIXME - must be a better way to prepopulate

		$quoteSan = '';
		if (isset($_GET['quote'])) {
			$quoteRaw = $_GET['quote'];
			if ($quoteRaw) {
				$quoteSan = Convert::raw2sql($quoteRaw);
			}	
		}


		$anySan = '';
	    if (isset($_GET['any'])) {
	      $anyRaw = $_GET['any'];
	      if ($anyRaw) {
	        $anySan = Convert::raw2sql($anyRaw);
	      } 
	    }


	    $withoutSan = '';
	    if (isset($_GET['-'])) {
	      $withoutRaw = $_GET['-'];
	      if ($withoutRaw) {
	        $withoutSan = Convert::raw2sql($withoutRaw);
	      } 
	    }


	    $withSan = '';
	    if (isset($_GET['+'])) {
	      $withRaw = $_GET['+'];
	      if ($withRaw) {
	        $withSan = Convert::raw2sql($withRaw);
	      } 
	     }



		$fromSan = '';
	    if (isset($_GET['From'])) {
	      $fromRaw = $_GET['From'];
	      if ($fromRaw) {
	        $fromSan = Convert::raw2sql($fromRaw);
	      } 
	    }


	    $toSan = '';
    if (isset($_GET['To'])) {
      $toRaw = $_GET['To'];
      if ($toRaw) {
        $toSan = Convert::raw2sql($toRaw);
      } 
    }


    $sortBySan = 'Relevance';


    if (isset($_GET['sortby'])) {
      $sortByRaw = $_GET['sortby'];
      if ($sortByRaw) {
        $sortBySan = Convert::raw2sql($sortByRaw);
      } 
    }
					


		if(!$fields) {
			error_log("SAP: NEW fields");
			$fields = new FieldList(
				$searchBy = new CompositeField(
					new TextField("+", _t('AdvancedSearchForm.ALLWORDS', 'All Words'), $withSan),
					new TextField("quote", _t('AdvancedSearchForm.EXACT', 'Exact Phrase'), $quoteSan),
					new TextField("any", _t('AdvancedSearchForm.ATLEAST', 'At Least One Of the Words'), $anySan),
					new TextField("-", _t('AdvancedSearchForm.WITHOUT', 'Without the Words'), $withoutSan)
				),
				$sortBy = new CompositeField(
					$dd = new DropdownField("sortby", _t('AdvancedSearchForm.SORTBY', 'Sort By'),
						array(
						     'Relevance' => _t('AdvancedSearchForm.RELEVANCE', 'Relevance'),
							'LastUpdated' => _t('AdvancedSearchForm.LASTUPDATED', 'Last Updated'),
							'PageTitle' => _t('AdvancedSearchForm.PAGETITLE', 'Page Title'),
						),
						$sortBySan
					)
				)				
			);
			
			$searchBy->ID = "AdvancedSearchForm_SearchBy";
			//FIXME$searchOnly->ID = "AdvancedSearchForm_SearchOnly";
			$sortBy->ID = "AdvancedSearchForm_SortBy";

			if (isset(self::$fieldCssClasses)) {
				foreach ($searchBy->getChildren() as $key => $field) {
					$field->addExtraClass(self::$fieldCssClasses);
				}

				$dd->addExtraClass(self::$fieldCssClasses);
			}
			
//chooseDate->ID = "AdvancedSearchForm_ChooseDate";
		}
		
		if(!$actions) {
			$actions = new FieldList(
				$fa = new FormAction("results", _t('AdvancedSearchForm.Search', 'Search'))
			);
		}

		if (isset(self::$buttonCssClasses)) {
			$fa->addExtraClass(self::$buttonCssClasses);
		}

		parent::__construct($controller, $name, $fields, $actions);
	}

	public function forTemplate(){
		return $this->renderWith(array("AdvancedSearchForm","Form"));
	}
	
	/* Return dataObjectSet of the results, using the form data.
	 */
	//public function getResults($numPerPage = 10) {
	public function getResults($pageLength = 10, $data = null){

		$numPerPage = $pageLength;

		$data = $this->getData();
		$keywords = '';
		$fileFilter = '';
		$filter = '';
		$invertedMatch = '';
		$contentFilter = '';

	 	if($data['+']) $keywords .= " +" . preg_replace("/ +/", " +", trim($data['+']));
	 	if($data['quote']) $keywords .= ' "' . $data['quote'] . '"';
	 	if($data['any']) $keywords .= ' ' . $data['any'];
	 	if($data['-']) $keywords .= " -" . preg_replace("/ +/", " -", trim($data['-']));
	 	$keywords = trim($keywords);
	 	
	 	// This means that they want to just find pages where there's *no* match
	 	
	 	if (isset($keywords[0])) {
	 		if($keywords[0] == '-') {
		 		$keywords = $data['-'];
		 		$invertedMatch = true;
		 	}
	 	}
error_log("T1");
	 	
	 	// Limit search to various sections
	 	if(isset($_REQUEST['OnlyShow'])) {
	 		$pageList = array();

	 		error_log("T2");

			// Find the associated pages	 		
	 		foreach($_REQUEST['OnlyShow'] as $section => $checked) {
	 			$items = explode(",", $section);
	 			foreach($items as $item) {
	 				$page = DataObject::get_one('SiteTree', "\"URLSegment\" = '" . DB::getConn()->addslashes($item) . "'");
	 				$pageList[] = $page->ID;
	 				if(!$page) user_error("Can't find a page called '$item'", E_USER_WARNING);
	 				$page->loadDescendantIDListInto($pageList);
	 			}
	 		}	
	 		$contentFilter = "\"ID\" IN (" . implode(",", $pageList) . ")";
	 		
	 		// Find the files associated with those pages
	 		$fileList = DB::query("SELECT \"FileID\" FROM \"Page_ImageTracking\" WHERE \"PageID\" IN (" . implode(",", $pageList) . ")")->column();
	 		if($fileList) $fileFilter = "\"ID\" IN (" . implode(",", $fileList) . ")";
	 		else $fileFilter = " 1 = 2 ";
	 	}


	 	/*
	 	if($data['From']) {
	 		$filter .= ($filter?" AND":"") . " \"LastEdited\" >= '$data[From]'";
	 	}
	 	if($data['To']) {
	 		$filter .= ($filter?" AND":"") . " \"LastEdited\" <= '$data[To]'";
	 	}
	 	*/
	 	if($filter) {
	 		$contentFilter .= ($contentFilter?" AND":"") . $filter;
	 		$fileFilter .= ($fileFilter?" AND":"") . $filter;
	 	}
	 	
	 	if($data['sortby']) {
	 		error_log("FOUND SORTY BY");
	 		$sorts = array(
	 			'LastUpdated' => 'LastEdited DESC',
	 			'PageTitle' => 'Title ASC',
	 			'Relevance' => 'Relevance DESC',
	 		);
	 		$sortBy = $sorts[$data['sortby']] ? $sorts[$data['sortby']] : $sorts['Relevance'];

	 		error_log("SORT BY = ".$sortBy);
	 	}

		$keywords = $this->addStarsToKeywords($keywords);

/*
		error_log("KEYWORDS:".$keywords);
		error_log("NUM PER PAGE".$numPerPage);
		error_log("SORT BY:".$sortBy);
		error_log("CONTENT FILTER:".$contentFilter);
		error_log("FILE FILTER:".$fileFilter);
		error_log("INVERTED MATCH:".$invertedMatch);
*/

		$start = isset($_GET['start']) ? (int)$_GET['start'] : 0;
	 	
	 	$results = DB::getConn()->searchEngine($this->classesToSearch, $keywords, $start, $numPerPage,
		 	$sortBy, $contentFilter, true, $fileFilter, $invertedMatch
		 );

	 	error_log("AFTER SEARCH:");
	 	error_log(print_r($results,1));

	 	return $results;
	}
	
	public function getSearchQuery($data = null) {
		error_log("Getting ksearch query");
		$data = $_REQUEST;
		$keywords = '';
	 	if($data['+']) $keywords .= " +" . preg_replace("/ +/", " +", trim($data['+']));
	 	if($data['quote']) $keywords .= ' "' . $data['quote'] . '"';
	 	if($data['any']) $keywords .= ' ' . $data['any'];
	 	if($data['-']) $keywords .= " -" . preg_replace("/ +/", " -", trim($data['-']));	
	 	
	 	error_log($keywords);
	 	return trim($keywords);
	}
	
}

?>