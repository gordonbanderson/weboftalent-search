<?php
/**
 * Check that at least one of the search fields has data entered
 */
class AdvancedSearchFormValidator extends RequiredFields {

	protected $fields, $member, $unique = array();



	/**
	 * JavaScript validation is disabled on profile forms.
	 */
	public function javascript() {
		return null;
	}

	public function php($data) {
		$member   = Member::currentUser();
		$valid    = true;

		error_log("Advanced search form validator");
		error_log(print_r($data, 1));

		// check the accept terms
		//if ($data['AcceptTerms'] == false) {
		//	$this->validationError('AcceptTerms', 'Please accept the terms and conditions', 'required');
		//}

		// check title
		if($data['any'] == false) {
			$this->validationError('any', _t('AdvancedSearchForm.SEARCH_TERM', 'Please provide at least one search term'));
			$valid = false;
		}
		
	

		return $valid && parent::php($data);
	}

}

