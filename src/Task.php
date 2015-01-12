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
    * A reference to the runner that is running the task
    * 
    * @var sndsgd\task\Runner
    */
   protected $runner;

   /**
    * Create the task and optionally add fields to it
    */
   public function __construct(array $fields = null)
   {
      parent::__construct($fields);
   }

   /**
    * Run the task
    */
   abstract public function run();

   /**
    * Set the runner
    * 
    * @param \sndsgd\task\Runner $runner
    */
   public function setRunner(Runner $runner)
   {
      $this->runner = $runner;
   }

   /**
    * Get the runner
    * 
    * @return \sndsgd\task\Runner
    */
   public function getRunner()
   {
      return $this->runner;
   }

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

