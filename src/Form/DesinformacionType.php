<?php

namespace App\Form;
use App\Entity\Desinformacion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class DesinformacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $isEdit = $options['is_edit']; // Obtenemos la opción personalizada

        $builder
            ->add('titular', TextType::class)
            ->add('contenido', TextareaType::class)
            ->add('fecha_registro', DateTimeType::class, [
                'widget' => 'single_text',
                'disabled' => $isEdit, // Deshabilitar solo en modo edición
            ])
            ->add('red_social', ChoiceType::class, [
                'choices' => [
                    'Facebook' => 'facebook',
                    'Twitter' => 'twitter',
                    'Instagram' => 'instagram',
                    'TikTok' => 'tiktok',
                    'YouTube' => 'youtube'
                ]
            ])
            ->add('multimedia', FileType::class, [
                'required' => false,
                'mapped' => false, // No mapeamos directamente a la entidad
            ])
            ->add('palabras_clave', TextType::class)
            ->add('estado_interno', ChoiceType::class, [
                'choices' => [
                    'Desmentido' => 'desmentido',
                    'No Verificable' => 'no verificable',
                    'En Investigación' => 'en investigación',
                ]
            ])
            ->add('observaciones', TextareaType::class, [
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Desinformacion::class,
            'is_edit' => false, // Valor por defecto para la opción personalizada
        ]);
    }
}
