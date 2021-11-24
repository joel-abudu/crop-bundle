<?php
namespace Breithbarbot\CropperBundle\Twig\Extension;
use Symfony\Component\Asset\Packages;
class AssetExtension extends \Twig_Extension
{
    private $packages;
    public function __construct(Packages $packages)
    {
        $this->packages = $packages;
    }
    public function getFunctions(): array
    {
        return [
            new \Twig_SimpleFunction('breithbarbot_cropper_asset', [$this, 'getPath']),
        ];
    }
    public function getPath($entity): string
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
