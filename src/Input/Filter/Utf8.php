<?php

class MediaWikiStatGadgetInputFilterUtf8 implements MediaWikiStatGadgetInputFilter {

  function value($value) {
    $result = mb_check_encoding($value, 'UTF-8');
    if (false === $result) {
      throw new MediaWikiStatGadgetInputException("Not a valid UTF-8 string.");
    }
    return $value;
  }

}
