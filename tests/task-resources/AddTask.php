<?php

namespace sndsgd\task;

use sndsgd\Field;
use sndsgd\field\rule\MinValueCount;
use sndsgd\field\rule\Required;


/**
 * @codeCoverageIgnore
 */
class ExampleAddTask extends \sndsgd\Task
{
   const VERSION = '1.0.0';
   const DESCRIPTION = 'add two or more values';

   /**
    * {@inheritdoc}
    */
   public function __construct(array $fields = null)
   {
      parent::__construct($fields);
      $this->addFields([
         Field::float('value')
            ->setDescription('A value to add')
            ->setExportHandler(Field::EXPORT_ARRAY)
            ->addRules(
               new Required,
               new MinValueCount(2)
            )
      ]);
   }

   /**
    * {@inheritdoc}
    */
   public function run()
   {
      $opts = $this->exportValues();
      $numbers = $opts['value'];
      $ret = array_shift($numbers);
      $len = count($numbers);
      for ($i=0; $i<$len; $i++) {
         $ret += $numbers[$i];
      }
      return $ret;
   }
}

