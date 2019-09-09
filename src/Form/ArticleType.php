<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('picture', FileType::class, [
                'label' => 'Image',
                'data_class' => null,
                'attr' => array('type' => 'file'),
                'required' => true,
            ])
            ->add('title')
            ->add('content')
            /*            ->add('publicationDate', DateType::class, array(
                           'widget' => 'single_text',
                           'attr' => array('class' => 'datepicker',
                               'data-format' => 'yyyy-mm-dd',
                           ),
                       ))
                      ->add('lastUpdateDate', DateType::class, array(
                           'widget' => 'single_text',
                           'attr' => array('class' => 'datepicker',
                               'data-format' => 'yyyy-mm-dd',
                           ),
                       ))*/
            ->add('isPublished', CheckboxType::class, array(
                'required' => false,
                'attr' => array('type' => 'checkbox','checked'=> "checked"
                ),
            ))
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => function (Category $category) {
                    return $category->getLabel();

                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
