<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet;

use Metinet\Http\Request;

class ControllerResolver
{
    private $controllers = [];
    private $matcher;

    public function __construct(RouteMatcher $routeMatcher)
    {
        $this->matcher = $routeMatcher;
    }

    public function resolve(Request $request)
    {
        list($matchedController, $matchedAction) = explode(
            '::',
            $this->matcher->match($request)
        );

        $controllers = [];

        foreach ($controllers as $controller) {
            if ((get_class($controller) === $matchedController)) {

                return [$controller, $matchedAction];
            }
        }
    }

    public function addController($controllerInstance)
    {
        $this->controllers[] = $controllerInstance;
    }
}
