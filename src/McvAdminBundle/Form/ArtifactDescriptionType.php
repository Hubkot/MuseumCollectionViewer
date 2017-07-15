<?php

namespace McvAdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtifactDescriptionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('artifact_id')->add('title')->add('story')->add('detail')->add('technique')->add('material')->add('author')->add('workshop')->add('publisher')->add('author_nots')->add('copyrights')->add('financed')->add('createdAt')->add('createdAt_nots')->add('height')->add('width')->add('depth')->add('weight')->add('measurement_nots')->add('buy_cost')->add('current_value')->add('modification_history');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'McvAdminBundle\Entity\ArtifactDescription'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mcvadminbundle_artifactdescription';
    }


}
