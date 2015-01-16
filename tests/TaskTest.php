<?php

namespace sndsgd;

use \org\bovigo\vfs\vfsStream;
use \sndsgd\Task;
use \sndsgd\task\ExampleTaskRunner;
use \sndsgd\task\ExampleAddTask;


/**
 * @coversDefaultClass \sndsgd\Task
 */
class TaskTest extends \PHPUnit_Framework_TestCase
{
   /**
    * @coversNothing
    */
   public static function setUpBeforeClass()
   {
      $dir = __DIR__.'/task-resources';
      $files = array_diff(scandir($dir), ['.','..']);
      foreach ($files as $filename) {
         require_once "$dir/$filename";
      }
   }

   /**
    * @covers ::validateClassname
    */
   public function testValidateClassname()
   {
      $this->assertTrue(Task::validateClassname('sndsgd\task\ExampleAddTask'));
      $this->assertTrue(Task::validateClassname('sndsgd\task\ExampleMultiplyTask'));
      $this->assertTrue(Task::validateClassname('sndsgd\task\ExampleNestedTask'));
      $this->assertFalse(Task::validateClassname('StdClass'));
   }

   /**
    * @covers ::validateClassname
    * @expectedException ReflectionException
    */
   public function testValidateClassnameException()
   {
      Task::validateClassname('THIS_CLASS_DOESNT_EXIST');
   }   

   public function testAddTaskNoRunner()
   {
      $input = [
         'value' => [1,2,3]
      ];

      $task = new \sndsgd\task\ExampleAddTask();
      $task->addValues($input);
      $this->assertTrue($task->validate());
      $this->assertEquals(6, $task->run());
   }

   /**
    * @covers ::__construct
    * @covers ::run
    */
   public function testAddTask()
   {
      $input = [
         'value' => [1,2,3]
      ];

      $runner = new ExampleTaskRunner('sndsgd\\task\\ExampleAddTask');
      $result = $runner->run($input);
      $this->assertEquals(6, $result);
   }

   /**
    * @covers ::__construct
    * @covers ::run
    */
   public function testMultiplyTask()
   {
      $input = [
         'value' => [1,2,3]
      ];

      $runner = new ExampleTaskRunner('sndsgd\\task\\ExampleMultiplyTask');
      $result = $runner->run($input);
      $this->assertEquals(6, $result);
   }

   /**
    * @covers ::getDescription
    */
   public function testGetDescription()
   {
      $task = new ExampleAddTask;
      $this->assertTrue(is_string($task->getDescription()));
   }

   /**
    * @covers ::getVersion
    */
   public function testGetVersion()
   {
      $task = new ExampleAddTask;
      $this->assertTrue(is_string($task->getVersion()));
   }
}

