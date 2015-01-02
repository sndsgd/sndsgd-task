<?php

use \sndsgd\Task;


class RunnerTest extends PHPUnit_Framework_TestCase
{
   protected $task;
   protected $runner;

   /**
    * @covers \sndsgd\Task
    * @covers \sndsgd\task\Runner
    */
   public function setUp()
   {
      $this->task = new AddTask;
      $this->runner = new TaskRunner;
   }

   /**
    * @covers \sndsgd\task\Runner
    */
   public function testValidationErrors()
   {
      $result = $this->runner->run($this->task, [
         'value' => [1,2,3],
         'unknown' => 'this will not validate'
      ]);

      $this->assertNull($result);
   }

   /**
    * @covers \sndsgd\task\Runner
    * @expectedException InvalidArgumentException
    */
   public function testRunInvalidTask()
   {
      $this->runner->run(42, null);
   }
}

