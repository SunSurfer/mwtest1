<?php

error_reporting(E_ALL);

include_once(__DIR__.'/../src/config.php');
require_once(__DIR__.'/../src/Api.php');

class MediaWikiStatGadgetTopTest extends PHPUnit_Framework_TestCase {

  function testConstruct() {
    $api = new MediaWikiStatGadgetApi();
    $this->markTestIncomplete('TODO: test headers and http status code');
    $_GET['categoryName'] = 'Afrika_Borwa';
    $_GET['startDate'] = '2011-07-31';
    $_GET['endDate'] = '2013-10-17';
    $_GET['limit'] = '100';
    $api->execute();
  }

}


