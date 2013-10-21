<?php

error_reporting(E_ALL);

require_once(__DIR__.'/../../src/Input/Array.php');

class MediaWikiStatGadgetInputArrayTest extends PHPUnit_Framework_TestCase {

  function testConstruct() {
    $inputs = new MediaWikiStatGadgetInputArray();
    $_GET['categoryName'] = 'Afrika_Borwa';
    $_GET['startDate'] = '2011-07-31';
    $_GET['endDate'] = '2013-10-17';
    $_GET['limit'] = '100';
    $this->assertSame('Afrika_Borwa', $inputs->get('categoryName'));
    $this->assertSame('20110731000000', $inputs->get('startDate'));
    $this->assertSame('20131017000000', $inputs->get('endDate'));
    $this->assertSame(100, $inputs->get('limit'));
  }

  function testFilterUtf8Invalid() {
    $_GET['test'] = "\xfe";
    $filter = new MediaWikiStatGadgetInputFilterUtf8();
    $this->setExpectedException('MediaWikiStatGadgetInputException');
    $result = $filter->value($_GET['test']);
  }

  function testFilterDate() {
    $_GET['test'] = '2011-07-31';
    $filter = new MediaWikiStatGadgetInputFilterDate();
    $result = $filter->value($_GET['test']);
    $this->assertSame('20110731000000', $result);
  }

  function testFilterDateInvalid() {
    $_GET['test'] = '2011-07-1';
    $filter = new MediaWikiStatGadgetInputFilterDate();
    $this->setExpectedException('MediaWikiStatGadgetInputException');
    $result = $filter->value($_GET['test']);
  }


  function testFilterLimit() {
    $_GET['test'] = '100';
    $filter = new MediaWikiStatGadgetInputFilterInteger();
    $result = $filter->value($_GET['test']);
    $this->assertSame(100, $result);
  }

  function testFilterLimitZero() {
    $_GET['test'] = '0';
    $filter = new MediaWikiStatGadgetInputFilterInteger();
    $this->setExpectedException('MediaWikiStatGadgetInputException');
    $result = $filter->value($_GET['test']);
  }

  function testFilterLimitNegative() {
    $_GET['test'] = '-1';
    $filter = new MediaWikiStatGadgetInputFilterInteger();
    $this->setExpectedException('MediaWikiStatGadgetInputException');
    $result = $filter->value($_GET['test']);
  }



}


