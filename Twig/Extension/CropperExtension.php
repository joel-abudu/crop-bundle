<?php
namespace Breithbarbot\CropperBundle\Twig\Extension;
use Symfony\Component\Asset\Packages;
class CropperExtension extends \Twig_Extension
{
    private $packages;
    public function __construct(Packages $packages)
    {
        $this->packages = $packages;
    }
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('breithbarbot_cropper_asset', [$this, 'getPath']),
        ];
    }
    public function getPath($entity)
    {
        if (!empty($entity)) {
            return $this->packages->getUrl($entity->getPath());
        }
        return '';
    }
    public function getName()
    {
        return 'breithbarbot_cropper_asset';
    }
}