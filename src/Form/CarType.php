<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Dealer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('color', TextType::class, ['label' => 'Couleur'])
            ->add('model', TextType::class, ['label' => 'Modèle'])
            ->add('seats', IntegerType::class, ['label' => 'Nombre de places'])
            ->add('engine', TextType::class, ['label' => 'Moteur']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
