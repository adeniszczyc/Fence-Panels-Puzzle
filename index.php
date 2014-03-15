<?php

// For PHP, set memory limit high enough to process
ini_set('memory_limit', '2048M');

/*  Start by looking at possible combinations with 2 panels:
    1 2   2 1   3 1 
    1 3   2 3   3 2

    We'll just focus on "1 2" then multiply by six for the rest
*/


  // Array holding the combinations
  $combinations = [];

  // Set iterator to 0
  $i = 0;

  /* Start loop that runs for a set amount of loops:
     - the higher the runs, the slower the process
     - the higher the runs, the more accurate the result
  */

  // Set combination length
  $length = 24;

  while ($i < 6000000) {

    // Set start charcters
    $item = "121312";
    
    // Get current length of combination
    $v = strlen($item);

    // Check if (n) of current digit less than the desired length
    while ($v < $length) {
     
      // Get random number between 1 and 3
      $random = rand(1, 3);

      // Check that previous digit does not equal calculated digit
      if (intval(substr($item, -1)) !== $random) {
        
        // If last digit, check it dows't equal the first digit
        if ($v == $length-1) {

          if (intval(substr($item,0, 1)) == $random) { 
            continue; 
          }

        }

        // If all is good add digit to combination
        $item .= $random;
        $v++;
      }
      
    }

    // If combination finished, add it to $combinations array
    array_push($combinations, $item);
    $i++;
  }


  // Remove duplicates from array
  $combinations_unique = array_unique($combinations);

  file_put_contents("combinations.txt",  implode(" ", $combinations_unique));

  echo "Caluclated strings: " . count($combinations) . "<br/><br/>";
  echo "Caluclated unique strings: " . count($combinations_unique) . "<br/><br/>";

?>