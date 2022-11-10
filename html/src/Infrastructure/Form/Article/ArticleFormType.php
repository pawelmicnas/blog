<?php declare(strict_types=1);

namespace Blog\Infrastructure\Form\Article;

use Blog\Application\Article\ArticleDTO;
use Blog\Infrastructure\Validator\Constraints\ContainsForbiddenHTMLTags;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class ArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'constraints' => [new NotNull(), new NotBlank(), new Length(min: 10, max: 80)],
            ])
            ->add('content', TextareaType::class, [
                'constraints' => [new NotNull(), new NotBlank(), new Length(min: 20), new ContainsForbiddenHTMLTags()],
            ])
            ->add('image', FileType::class, [
                'constraints' => new File([
                    'maxSize' => '1M',
                    'mimeTypes' => ['image/jpeg', 'image/jpg',],
                    'mimeTypesMessage' => 'Please upload a valid JPG image',
                ]),
            ])
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ArticleDTO::class,
        ]);
    }
}