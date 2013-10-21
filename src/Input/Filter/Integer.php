<?php

class MediaWikiStatGadgetInputFilterInteger implements MediaWikiStatGadgetInputFilter {

  function value($value) {
    if (true !== ctype_digit((string)$value)) {
      throw new MediaWikiStatGadgetInputException("Value is not a positive integer (only digits).");
    }
    $value = (int)$value;
    if (0 >= $value) {
      throw new MediaWikiStatGadgetInputException("Value is not greater 0.");
    }
    return $value;
  }

}
