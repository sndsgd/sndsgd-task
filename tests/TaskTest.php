<?php

use \org\bovigo\vfs\vfsStream;
use \sndsgd\Task;


class TaskTest extends PHPUnit_Framework_TestCase
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
      $this->task->setRunner($this->runner);
   }

   /**
    * @covers \sndsgd\Task::validateClassname
    */
   public function testValidateClassname()
   {
      $this->assertTrue(Task::validateClassname('AddTask'));
      $this->assertTrue(Task::validateClassname('MultiplyTask'));
      $this->assertTrue(Task::validateClassname('NestedTask'));
      $this->assertFalse(Task::validateClassname('StdClass'));
   }

   /**
    * @covers \sndsgd\Task::validateClassname
    * @expectedException ReflectionException
    */
   public function testValidateClassnameException()
   {
      $this->assertTrue(Task::validateClassname('THIS_CLASS_DOESNT_EXIST'));
   }   

   /**
    * @covers \sndsgd\Task
    * @expectedException Exception
    */
   public function testSetRunner()
   {
      $this->task->setRunner($this->runner);
   }

   /**
    * @covers \sndsgd\Task
    */
   public function testGetRunner()
   {
      $this->assertInstanceOf('sndsgd\\task\Runner', $this->task->getRunner());
   }

   /**
    * @covers \sndsgd\Task
    * @covers \sndsgd\task\Runner
    */
   public function testAddTask()
   {
      $input = [
         'value' => [1,2,3]
      ];

      $task = new AddTask;
      $runner = new TaskRunner;
      $result = $runner->run($task, $input);
      $this->assertEquals(6, $result);
   }

   /**
    * @covers \sndsgd\Task
    * @covers \sndsgd\task\Runner
    */
   public function testMultiplyTask()
   {
      $input = [
         'value' => [1,2,3]
      ];

      $task = new MultiplyTask;
      $runner = new TaskRunner;
      $result = $runner->run($task, $input);
      $this->assertEquals(6, $result);
   }
}

