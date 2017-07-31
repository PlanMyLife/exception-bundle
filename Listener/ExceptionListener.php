<?php

namespace PlanMyLife\ExceptionBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Kernel;

class ExceptionListener
{
    /**
     * @var EngineInterface
     */
    protected $templateEngine;

    /**
     * @var Kernel
     */
    protected $kernel;

    /**
     * @var string
     */
    protected $layout;

    /**
     * ExceptionListener constructor.
     *
     * @param EngineInterface $templateEngine
     * @param Kernel          $kernel
     * @param $layout
     */
    public function __construct(EngineInterface $templateEngine, Kernel $kernel, $layout)
    {
        $this->templateEngine = $templateEngine;
        $this->kernel = $kernel;
        $this->layout = $layout;
    }

    /**
     * @param GetResponseForExceptionEvent $event
     *
     * @return GetResponseForExceptionEvent
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();
        $template = sprintf($this->layout, 'error');

        $debug = in_array($this->kernel->getEnvironment(), ['test', 'dev']);

        // Display the new exception page if you'r not in the dev mode.
        if (!$debug) {
            $response = $this->templateEngine->render($template, [
                'code' => method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() :
                    method_exists($exception, 'getCode') ? $exception->getCode() : '404',
                'message' => $exception->getMessage(),
            ]);

            $event->setResponse(new Response($response));
        }
    }

    /**
     * Authorize html request.
     *
     * @param $request
     *
     * @return bool
     */
    protected function getTypeFormat($request)
    {
        if ($request === 'html') {
            return true;
        }

        return false;
    }
}
