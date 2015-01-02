<?php

use \org\bovigo\vfs\vfsStream;
use \sndsgd\Task;
use \sndsgd\task\Collection;
use \sndsgd\field\Field;
use \sndsgd\util\Str;


/**
 * @codeCoverageIgnore
 */
class TaskRunnerInvalidGetTaskFromCollection extends TaskRunner
{
   protected function getTaskFromCollection(Collection $c, $data)
   {
      return [null, null];
   }
}

