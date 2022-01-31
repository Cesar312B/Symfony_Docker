<?php

namespace App\Form;

use App\Entity\HorasExtra;
use App\Entity\ValorHoras;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HorasExtraType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('valor_horas',EntityType::class,[
                'class'=> ValorHoras::class,
                'choice_label' => 'hora_extra',

            ])
            ->add('actividad')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => HorasExtra::class,
        ]);
    }
}
