<?php

namespace sndsgd;

use \Exception;
use \ReflectionClass;
use \sndsgd\field\Collection as FieldCollection;
use \sndsgd\task\Runner;


/**
 * A base class for tasks that can be run in various environments
 */
abstract class Task
{
   /**
    * Verify a classname is a subclass of sndsgd\Task
    * 
    * @param string $classname The classname to test
    * @return boolean
    * @throws ReflectionException If the provided classname does not exist
    */
   public static function validateClassname($classname)
   {
      $class = new ReflectionClass($classname);
      while ($class = $class->getParentClass()) {
         if ($class->getName() === 'sndsgd\\Task') {
            return true;
         }
      }
      return false;
   }

   /**
    * A field collection for input data
    *
    * @var sndsgd\field\Collection
    */
   protected $fieldCollection;

   /**
    * The task runner instance
    *
    * @var sndsgd\task\Runner
    */
   protected $runner = null;

   /**
    * Constructor
    * 
    */
   public function __construct()
   {
      $this->fieldCollection = new FieldCollection();
   }

   /**
    * Get a description of what the task does
    *
    * @return string
    */
   abstract public function getDescription();

   /**
    * Run the task
    *
    * @param array.<string,mixed> $values
    */
   abstract public function run(array $values);

   /**
    * Get the field collection
    * 
    * @return sndsgd\field\Collection
    */
   public function getFieldCollection()
   {
      return $this->fieldCollection;
   }

   /**
    * Register the task runner to run the task
    * 
    * @return void
    */
   public function setRunner(Runner $runner)
   {
      if ($this->runner !== null) {
         throw new Exception("The task runner has already been set");
      }
      $this->runner = $runner;
   }

   /**
    * Get the task runner instance
    *
    * @return sndsgd\task\Runner
    */
   public function getRunner()
   {
      return $this->runner;
   }
}

