<?php

namespace PlanMyLife\ExceptionBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use PlanMyLife\ExceptionBundle\DependencyInjection\PlanMyLifeExceptionExtension;
use PlanMyLife\ExceptionBundle\DependencyInjection\Compiler\ExceptionCompilerPass;

class PlanMyLifeExceptionBundle extends Bundle
{
    /**
     * @return PlanMyLifeExceptionExtension
     */
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            return new PlanMyLifeExceptionExtension();
        }

        return $this->extension;
    }

    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ExceptionCompilerPass());
    }
}
