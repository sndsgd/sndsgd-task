<?php

use sndsgd\Field;
use sndsgd\field\rule\MinValueCount;
use sndsgd\field\rule\Required;


/**
 * @codeCoverageIgnore
 */
class NestedTask extends AddTask
{
   /**
    * {@inheritdoc}
    */
   public function getDescription()
   {
      return "THIS EXISTS SOLEY TO TEST Task::validateClassname";
   }

   /**
    * {@inheritdoc}
    */
   public function run(array $values = null)
   {
      return true;
   }
}

