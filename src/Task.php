<?php

namespace sndsgd;

use \Exception;
use \ReflectionClass;
use \sndsgd\task\Runner;


/**
 * A base class for tasks that can be run in various environments
 */
abstract class Task extends \sndsgd\field\Collection
{
   /**
    * {@inheritdoc}
    */
   const EVENT_DATA_KEY = 'task';

   /**
    * All subclasses should override this constant with their version
    * 
    * @var string
    */
   const VERSION = '0.0.0';

   /**
    * All subclasses should override this constant with their description
    * 
    * @var string
    */
   const DESCRIPTION = 'No description provided';

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
    * Create the task and optionally add fields to it
    *
    * @param array.<sndsgd\Field> $fields 
    */
   public function __construct(array $fields = [])
   {
      parent::__construct($fields);
   }

   /**
    * Run the task
    */
   abstract public function run();

   /**
    * Get the task description
    * 
    * @return string
    */
   final public function getDescription()
   {
      return $this::DESCRIPTION;
   }

   /**
    * Get the task version number
    * 
    * @return string
    */
   final public function getVersion()
   {
      return $this::VERSION;
   }
}

