<?php

use sndsgd\Field;
use sndsgd\field\rule\MinValueCount;
use sndsgd\field\rule\Required;


/**
 * @codeCoverageIgnore
 */
class MultiplyTask extends \sndsgd\Task
{
   public function __construct()
   {
      parent::__construct();
      $this->fieldCollection->addFields(
         Field::float('value')
            ->setDescription('A value to multiply')
            ->setExportHandler(Field::EXPORT_ARRAY)
            ->addRules(
               new Required,
               new MinValueCount(2)
            )
      );
   }

   /**
    * {@inheritdoc}
    */
   public function getDescription()
   {
      return "multiply two or more values";
   }

   /**
    * {@inheritdoc}
    */
   public function run(array $values = null)
   {
      $numbers = $values['value'];
      $ret = array_shift($numbers);
      $len = count($numbers);
      for ($i=0; $i<$len; $i++) {
         $ret *= $numbers[$i];
      }
      return $ret;
   }
}

