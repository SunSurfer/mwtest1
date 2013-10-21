<?php

require_once(__DIR__.'/Input/Array.php');

class MediaWikiStatGadgetToppagesincategory {

  function execute() {
    $inputs = new MediaWikiStatGadgetInputArray();

    ini_set('pdo_mysql.debug', true);
    $pdoDriverOptions = array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_EMULATE_PREPARES => false,
    );
    $pdo = new PDO(PDO_DSN.';charset=utf8', PDO_USER, PDO_PASSWORD, $pdoDriverOptions);
    $statement = $pdo->prepare('
      SELECT p.page_title, count(r.rev_id)
      FROM categorylinks AS cl
      INNER JOIN revision AS r ON cl.cl_from = r.rev_page
      INNER JOIN page AS p ON cl.cl_from = p.page_id
      WHERE cl.cl_to = ?
        AND r.rev_timestamp >= ?
        AND r.rev_timestamp < ?
      GROUP BY cl.cl_from
      ORDER BY count(r.rev_id) DESC
      LIMIT ?;
    ');
    $arguments = array(
      $inputs->get('categoryName'),
      $inputs->get('startDate'),
      $inputs->get('endDate'),
      $inputs->get('limit'),
    );

    $timeStart = microtime(TRUE);
    $statement->execute($arguments);
    $timeFinish = microtime(TRUE);
    $rows = $statement->fetchAll(PDO::FETCH_NUM);

    $result = json_encode(array('topPagesWithCount' => $rows, 'secondsMysqlExecutionTime' => $timeFinish - $timeStart), JSON_PRETTY_PRINT);
    return $result;
  }
}
