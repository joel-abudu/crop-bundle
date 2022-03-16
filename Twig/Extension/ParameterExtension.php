<?php
namespace Breithbarbot\CropperBundle\Twig\Extension;
use Symfony\Component\DependencyInjection\Container;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
class ParameterExtension extends AbstractExtension
{
    private Container $container;
    public function __construct(Container $container)
    {
        $this->container = $container;
    }
    public function getFunctions(): array
    {
        return [
            new TwigFunction('breithbarbot_cropper_parameter', [$this, 'getParameter']),
        ];
    }
    public function getParameter(string $name): string
    {
        if (!empty($name)) {
            return $this->container->getParameter($name);
        }
        return '';
    }
    public function getName(): string
    {
        return 'breithbarbot_cropper_parameter';
    }
}
