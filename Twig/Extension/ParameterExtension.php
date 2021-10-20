<?php
namespace Breithbarbot\CropperBundle\Twig\Extension;
class ParameterExtension extends \Twig_Extension
{
    private $container;
    public function __construct($container)
    {
        $this->container = $container;
    }
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('breithbarbot_cropper_parameter', [$this, 'getParameter']),
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
