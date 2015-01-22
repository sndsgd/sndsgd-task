<?php

namespace sndsgd\task;

use \Exception;
use \InvalidArgumentException;
use \sndsgd\Env;
use \sndsgd\Task;


/**
 * A base class for task runners
 */
class Runner
{
   /**
    * The task to run
    * 
    * @var sndsgd\Task
    */
   protected $task;

   /**
    * Constructor
    * 
    * @param string $classname The name of a task class
    * @param array.<sndsgd\Field> $fields Fields to inject into the task
    */
   public function __construct($classname, array $fields = [])
   {
      if (Task::validateClassname($classname) === false) {
         throw new InvalidArgumentException(
            "invalid value provided for 'classname'; expecting the name of ".
            "a subclass of sndsgd\Task as string"
         );
      }

      $this->task = new $classname($fields);
   }

   /**
    * Terminate the script
    *
    * This method exists for testing purposes
    * @param integer $exitcode
    */
   public function terminate($exitcode)
   {
      Env::terminate($exitcode);
   }

   /**
    * Get the task instance
    * 
    * @return sndsgd\Task
    */
   public function getTask()
   {
      return $this->task;
   }

   /**
    * Run a task
    *
    * @param mixed $data
    */
   public function run($data)
   {
      $this->task->addValues($data);
      if ($this->task->validate() === true) {
         return $this->task->run();
      }
      
      $errors = $this->task->getErrors();
      Env::error($this->formatErrors($errors));
   }

   /**
    * Format field errors for the runner environment
    * 
    * @param array.<sndsgd\field\Error> $errors
    * @return string
    */
   public function formatErrors(array $errors)
   {
      $tmp = [];
      $len = count($errors);
      if ($len === 0) {
         throw new InvalidArgumentException(
            "invalid value provided for 'errors'; expecting an array that ".
            "contains at least one instance of sndsgd\\field\\Error"
         );
      }

      $noun = ($len === 1) ? 'option' : 'options';
      $tmp = ["failed to process $noun"];
      foreach ($errors as $error) {
         $name = $error->getName();
         $message = $error->getMessage();
         if (!array_key_exists($name, $tmp)) {
            $tmp[$name] = " @[bold]$name@[reset] → $message";
         }
      }
      return implode(PHP_EOL, array_values($tmp)).PHP_EOL;
   }
}

