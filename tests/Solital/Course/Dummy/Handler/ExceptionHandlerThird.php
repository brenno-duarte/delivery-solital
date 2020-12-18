<?php

class ExceptionHandlerThird implements \Solital\Core\Course\Handlers\ExceptionHandlerInterface
{
	public function handleError(\Solital\Core\Http\Request $request, \Exception $error) : void
	{
        global $stack;
        $stack[] = static::class;

		throw new ResponseException('ExceptionHandler loaded');
	}

}