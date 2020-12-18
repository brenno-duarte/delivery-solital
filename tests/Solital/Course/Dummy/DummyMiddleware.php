<?php
require_once 'Exception/MiddlewareLoadedException.php';

use Solital\Core\Http\Request;

class DummyMiddleware implements \Solital\Core\Http\Middleware\MiddlewareInterface
{
	public function handle(Request $request) : void
	{
		throw new MiddlewareLoadedException('Middleware loaded!');
	}

}