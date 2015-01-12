<?php

namespace sndsgd\task;

use sndsgd\Field;
use sndsgd\field\rule\MinValueCount;
use sndsgd\field\rule\Required;


/**
 * @codeCoverageIgnore
 */
class ExampleNestedTask extends ExampleAddTask
{
   const VERSION = '1.0.0';
   const DESCRIPTION = 'THIS EXISTS SOLEY TO TEST Task::validateClassname';

   /**
    * {@inheritdoc}
    */
   public function run()
   {
      return true;
   }
}

