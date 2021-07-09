<?php
namespace Breithbarbot\CropperBundle\DependencyInjection\Compiler;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
class FormPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $template = "BreithbarbotCropperBundle:Form:fields.html.twig";
        $resources = $container->getParameter('twig.form.resources');
        if (!in_array($template, $resources)) {
            if (false !== ($key = array_search('fields.html.twig', $resources))) {
                array_splice($resources, ++$key, 0, $template);
            } else {
                array_unshift($resources, $template);
            }
            $container->setParameter('twig.form.resources', $resources);
        }
    }
}
