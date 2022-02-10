<?php
namespace Breithbarbot\CropperBundle\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class CropperType extends AbstractType
{
    private $container;
    public function __construct($container)
    {
        $this->container = $container;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        foreach ($options['additional_data'] as $key => $value) {
            $builder->add($key, HiddenType::class, ['mapped' => false, 'attr' => [$key => $value]]);
        }
        if (!empty($options['mapping'])) {
            $mapping = $this->container->getParameter('breithbarbot_cropper.mappings')[$options['mapping']];
            $builder->add('_width', HiddenType::class, ['mapped' => false, 'data' => $mapping['width']]);
            $builder->add('_height', HiddenType::class, ['mapped' => false, 'data' => $mapping['height']]);
        }
        if (!empty($options['identifier'])) {
            $builder->add('_identifier', HiddenType::class, ['mapped' => false, 'data' => $options['identifier']]);
        }
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'mapping' => null,
            'additional_data' => [],
            'identifier' => null,
        ]);
    }
    public function getBlockPrefix()
    {
        return 'breithbarbot_cropper_bundle_cropper_type';
    }
}
