<?php
/** Created by PhpStorm... */
class ListType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('someTask', 'task');
    }
}