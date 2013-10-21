<?php

class MediaWikiStatGadgetInputFilterDate implements MediaWikiStatGadgetInputFilter {

  function value($value) {
    if (1 !== preg_match('(^\d{4}-\d{2}-\d{2}$)', $value)) {
      throw new MediaWikiStatGadgetInputException("Value doesn't match format for date.");
    }
    $date = DateTime::createFromFormat('Y-m-d', $value);
    if (false === $date) {
      throw new MediaWikiStatGadgetInputException("DateTime::createFromFormat failed."); 
    }
    $date->setTime(0, 0);
    if (false === $date) {
      throw new MediaWikiStatGadgetInputException("DateTime::setTime failed.");
    }
    $dbstring = $date->format('YmdHis');
    if (false === $dbstring) {
      throw new MediaWikiStatGadgetInputException("DateTime::format failed.");
    }
    return $dbstring;
  }

}
