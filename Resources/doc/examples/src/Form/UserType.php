<?php
namespace App\Form;
use Breithbarbot\CropperBundle\Form\Type\BreithbarbotCropperType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $edit = (null !== $builder->getData()->getAvatar());
        $builder
            ->add('avatar', BreithbarbotCropperType::class, [
                'required' => false,
                'mapped' => $edit,
                'mapping' => 'user_avatar', 
                'additional_data' => [
                    'entity_id' => $builder->getData()->getId(), 
                ],
                'label' => false,
            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
        ]);
    }
}
