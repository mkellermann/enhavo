<?php
/**
 * ItemType.php
 *
 * @since 23/08/14
 * @author Gerhard Seidel <gseidel.message@googlemail.com>
 */

namespace esperanto\ContentBundle\Form\Type;

use esperanto\ContentBundle\Item\ItemTypeResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class ItemType extends AbstractType
{
    /**
     * @var ItemTypeResolver
     */
    protected $resolver;

    public function __construct(ItemTypeResolver $itemTypeResolver)
    {
        $this->resolver = $itemTypeResolver;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('order', 'hidden', array(
            'data' => 0
        ));

        $builder->add('type', 'hidden');

        $resolver = $this->resolver;
        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) use ($resolver){
            $item = $event->getData();
            $form = $event->getForm();
            if(!empty($item) && isset($item['type'])) {
                $form->add('itemType', $resolver->getFormType($item['type']));
            }
        });

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($resolver){
            $item = $event->getData();
            $form = $event->getForm();
            if(!empty($item) && $item->getType()) {
                $form->add('itemType', $resolver->getFormType($item->getType()));
            }
        });
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'esperanto\ContentBundle\Entity\Item'
        ));
    }

    public function getName()
    {
        return 'esperanto_content_item';
    }
} 