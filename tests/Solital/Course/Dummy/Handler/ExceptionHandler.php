<?php

class ExceptionHandler implements \Solital\Core\Course\Handlers\ExceptionHandlerInterface
{
	public function handleError(\Solital\Core\Http\Request $request, \Exception $error)  : void
	{
	    echo $error->getMessage();
	}

}