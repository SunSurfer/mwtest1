<?php

require_once(__DIR__.'/../../src/Input/Exception.php');
require_once(__DIR__.'/../../src/Input/Filter.php');
require_once(__DIR__.'/../../src/Input/Filter/Date.php');
require_once(__DIR__.'/../../src/Input/Filter/Integer.php');
require_once(__DIR__.'/../../src/Input/Filter/Utf8.php');

class MediaWikiStatGadgetInputArray {

  function __construct() {
    $this->addFilter('categoryName', new MediaWikiStatGadgetInputFilterUtf8());
    $this->addFilter('startDate', new MediaWikiStatGadgetInputFilterDate());
    $this->addFilter('endDate', new MediaWikiStatGadgetInputFilterDate());
    $this->addFilter('limit', new MediaWikiStatGadgetInputFilterInteger());
  }

  private $filters = array();

  private function addFilter($key, MediaWikiStatGadgetInputFilter $filter) {
    $this->filters[$key] = $filter;
  }

  private $filteredInput = NULL;

  public function filterInput() {
    $this->filteredInput = array();
    foreach ($this->filters as $key => $filter) {
      if (!isset($_GET[$key])) {
        throw new MediaWikiStatGadgetInputException("Required argument $key not set.");
      }
      $this->filteredInput[$key] = $filter->value($_GET[$key]);
    }
  }

  public function get($key) {
    if (is_null($this->filteredInput)) {
      $this->filterInput();
    }
    if (!isset($this->filteredInput[$key])) {
      throw new MediaWikiStatGadgetInputException("No key of that name.");
    }
    return $this->filteredInput[$key];
  }

}
