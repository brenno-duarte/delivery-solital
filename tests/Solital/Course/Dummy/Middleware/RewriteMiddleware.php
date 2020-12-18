<?php

use Solital\Core\Http\Middleware\MiddlewareInterface;
use Solital\Core\Http\Request;

class RewriteMiddleware implements MiddlewareInterface {

    public function handle(Request $request)  : void {

        $request->setRewriteCallback(function() {
            return 'ok';
        });

    }

}