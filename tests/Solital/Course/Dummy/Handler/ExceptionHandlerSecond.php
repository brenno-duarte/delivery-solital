<?php

class ExceptionHandlerSecond implements \Solital\Core\Course\Handlers\ExceptionHandlerInterface
{
	public function handleError(\Solital\Core\Http\Request $request, \Exception $error) : void
	{
        global $stack;
        $stack[] = static::class;

        $request->setUrl(new \Solital\Http\Url('/'));
	}

}