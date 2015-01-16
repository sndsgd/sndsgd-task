<?php

namespace sndsgd\task;


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

