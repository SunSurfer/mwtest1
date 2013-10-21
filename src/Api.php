<?php

require_once(__DIR__.'/Toppagesincategory.php');

class MediaWikiStatGadgetApi {

  private $output = "";

  function execute() {
    try {
      $top = new MediaWikiStatGadgetToppagesincategory();
      $this->output = $top->execute();
      header('Content-Type: application/json');
      echo $this->output;
    } catch(Exception $e) {
      http_response_code(400);
      echo "There was an error. Your arguments were probably unsound. See the server logs for the actual error. Do not forget to implement proper error output ;) .";
      //var_dump($e);
    }
  }
}
