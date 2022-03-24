<?php
namespace Breithbarbot\CropperBundle;
use Breithbarbot\CropperBundle\DependencyInjection\CompilerPass\FormPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
class BreithbarbotCropperBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);
        $container->addCompilerPass(new FormPass());
    }
}
