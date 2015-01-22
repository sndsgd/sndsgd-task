<?php

namespace sndsgd\task;

use \sndsgd\Field;
use \sndsgd\field\FloatField;
use \sndsgd\field\rule\MinValueCountRule;
use \sndsgd\field\rule\RequiredRule;


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
   public function __construct(array $fields = [])
   {
      parent::__construct($fields);
      $this->addFields([
         (new FloatField('value'))
            ->setDescription('a value to add')
            ->setExportHandler(Field::EXPORT_ARRAY)
            ->addRules([
               new RequiredRule,
               new MinValueCountRule(2)
            ])
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

