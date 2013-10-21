<?php

error_reporting(E_ALL);

include_once(__DIR__.'/../src/config.php');
require_once(__DIR__.'/../src/Toppagesincategory.php');

class MediaWikiStatGadgetToppagesincategoryTest extends PHPUnit_Framework_TestCase {

  function testConstruct() {
    $top = new MediaWikiStatGadgetToppagesincategory();
    $_GET['categoryName'] = 'Afrika_Borwa';
    $_GET['startDate'] = '2011-07-31';
    $_GET['endDate'] = '2013-10-17';
    $_GET['limit'] = '3';
    $result = json_decode($top->execute(), true);

    $this->assertGreaterThan(0, $result['secondsMysqlExecutionTime']);
    $result['secondsMysqlExecutionTime'] = 0;
    $expected = array(
      'topPagesWithCount' => array(
        0 => array(
          0 => 'Afrika_Borwa',
          1 => 40,
        ),
        1 => array(
          0 => 'Sesotho',
          1 => 26,
        ),
        2 => array(
          0 => 'Seisimane',
          1 => 26,
        ),
      ),
      'secondsMysqlExecutionTime' => 0,
    );
    $this->assertSame($expected, $result);
  }

}


