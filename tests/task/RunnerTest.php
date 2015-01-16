<?php

namespace sndsgd\task;

use \sndsgd\Env;
use \sndsgd\Task;
use \sndsgd\task\ExampleTaskRunner;


/**
 * @coversDefaultClass \sndsgd\task\Runner
 */
class RunnerTest extends \PHPUnit_Framework_TestCase
{
   protected $task;
   protected $runner;

   /**
    * @covers ::__construct
    * @covers \sndsgd\Task::setRunner
    */
   public function setUp()
   {
      $this->runner = new ExampleTaskRunner('sndsgd\\task\\ExampleAddTask');
      $class = 'sndsgd\\env\\Controller';
      $controller = $this->getMockBuilder($class)->getMock();
      $controller->method('terminate')->willReturn(true);
      Env::setController($controller);
   }

   /**
    * @covers ::__construct
    * @expectedException InvalidArgumentException
    */
   public function testInvalidTaskClassname()
   {
      new ExampleTaskRunner(new \StdClass);
   }

   /**
    * @covers ::terminate
    */
   public function testTerminate()
   {
      $this->runner->terminate(1);
   }

   /**
    * @covers ::getTask
    */
   public function testGetTask()
   {
      $this->assertInstanceOf('sndsgd\\Task', $this->runner->getTask());
   }

   /**
    * @covers ::run
    * @covers ::formatErrors
    */
   public function testValidationErrors()
   {
      $this->runner->run([
         'value' => [1,2,3],
         'unknown' => 'this will not validate'
      ]);
   }

   /**
    * @covers ::run
    */
   public function testSuccessfullRun()
   {
      $result = $this->runner->run([
         'value' => [1,2,3]
      ]);
      $this->assertEquals(6, $result);
   }

   /**
    * @covers ::formatErrors
    * @expectedException InvalidArgumentException
    */
   public function testFormatValidationErrorsException()
   {
      $this->runner->formatErrors([]);
   }
}

