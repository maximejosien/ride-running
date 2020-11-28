<?php

namespace App\Form;

use App\Entity\RideType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class RideFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('RideType', EntityType::class, [
                'required' => true,
                'class' => RideType::class,
                'choice_label' => 'name',
                'label' => 'Type de course',
            ])
            ->add('startAt', DateType::class, [
                'required' => true,
                'widget' => 'choice',
                'label' => 'Date de début',
            ])
            ->add('duration', NumberType::class, [
                'required' => true,
                'label' => 'Durée (en Minutes)',
            ])
            ->add('distance', NumberType::class, [
                'required' => true,
                'label' => 'Distance (en Mètres)',
            ])
            ->add('description',TextType::class, [
                'required' => true,
                'label' => 'Description',
            ])
            ->add('Appliquer', SubmitType::class)
        ;
    }
}
