<?php
namespace Breithbarbot\CropperBundle\Twig\Extension;
use Symfony\Component\DependencyInjection\Container;
use Twig_Extension;
use Twig_SimpleFunction;
class ParameterExtension extends Twig_Extension
{
    private Container $container;
    public function __construct(Container $container)
    {
        $this->container = $container;
    }
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('breithbarbot_cropper_parameter', [$this, 'getParameter']),
        ];
    }
    public function getParameter($name)
    {
        if (!empty($name)) {
            return $this->container->getParameter($name);
        }
        return '';
    }
    public function getName()
    {
        return 'breithbarbot_cropper_parameter';
    }
}
