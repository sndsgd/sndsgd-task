<?php

namespace sndsgd\task;

use \Exception;
use \InvalidArgumentException;
use \sndsgd\Debug;
use \sndsgd\Task;


/**
 * A base class for task runners
 */
abstract class Runner
{
   /**
    * The task to run
    * 
    * @var sndsgd\Task
    */
   protected $task;

   /**
    * Set the task to run
    *
    * @param sndsgd\Task $task
    * @return void
    */
   protected function setTask(Task $task)
   {
      $task->setRunner($this);
      $this->task = $task;
   }

   /**
    * Run a task
    *
    * @param sndsgd\Task $task
    * @param mixed $data
    */
   public function run($task, $data)
   {
      if (($task instanceof Task) === false) {
         throw new InvalidArgumentException(
            "invalid value provided for 'task'; ".
            "expecting an instance of sndsgd\\Task"
         );
      }

      $this->setTask($task);
      $fc = $this->task->getFieldCollection();
      $fc->addValues($data);
      if ($fc->validate() === false) {
         $msg = $this->formatValidationErrors($fc->getValidationErrors());
         Debug::error($msg);
         return null;
      }

      return $this->task->run($fc->exportValues());
   }

   /**
    * Format validation errors for the runner environment
    * 
    * @param array.<sndsgd\field\ValidationError> $errors
    * @return string
    */
   public function formatValidationErrors(array $errors)
   {
      $tmp = ['the following validation errors were encountered:'];
      foreach ($errors as $error) {
         $name = $error->getName();
         $message = $error->getMessage();
         $tmp[] = " {$name}: {$message}";
      }
      return implode(PHP_EOL, $tmp);
   }
}

