<?php

namespace PlanMyLife\ExceptionBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ExceptionCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if ($container->hasParameter('pml_exception.arguments')) {
            foreach ($container->getParameter('pml_exception.arguments') as $argument => $value) {
                if (strpos($value, '@') !== false) {
                    $container->getDefinition('pml.exception')
                        ->addArgument(new Reference(str_replace('@', '', $value)));
                } else {
                    $container->getDefinition('pml.exception')
                        ->addArgument($value);
                }
            }
        }
    }
}
