<?php

use \org\bovigo\vfs\vfsStream;
use \sndsgd\Task;
use \sndsgd\task\Collection;
use \sndsgd\Field;
use \sndsgd\util\Str;


/**
 * @codeCoverageIgnore
 */
class TaskRunner extends \sndsgd\task\Runner
{
   /**
    * {@inheritdoc}
    */
   public function setTask(Task $task)
   {
      parent::setTask($task);
      $fc = $task->getFieldCollection();
      $fc->addFields(Field::boolean('test'));
   }

   protected function getTaskFromCollection(Collection $c, $data)
   {
      $taskname = $data['command'];
      unset($data['command']);
      $task = $c->getTask($taskname);
      return [$task, $data];
   }
}

