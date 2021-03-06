<?php
/**
 * Created by PhpStorm.
 * User: jhelbing
 * Date: 23.06.16
 * Time: 10:29
 */

namespace Enhavo\Bundle\SearchBundle\Extractor\PropertyExtractor;

use Enhavo\Bundle\AppBundle\Type\AbstractType;
use Enhavo\Bundle\SearchBundle\Extractor\Extractor;
use Enhavo\Bundle\SearchBundle\Extractor\PropertyExtractorInterface;

class CollectionExtractor extends AbstractType implements PropertyExtractorInterface
{
    /**
     * @var Extractor
     */
    private $extractor;

    /**
     * CollectionExtractor constructor.
     * @param Extractor $extractor
     */
    public function __construct(Extractor $extractor)
    {
        $this->extractor = $extractor;
    }

    public function extract($value, $options = [])
    {
        $data = [];
        if($value) {
            foreach($value as $item) {
                if(is_string($item)) {
                    $data[] = trim($item);
                } elseif(is_object($value)) {
                    $extractions = $this->extractor->extract($item);
                    foreach($extractions as $extraction) {
                        $data[] = $extraction;
                    }
                }
            }
        }
        return $data;
    }

    /**
     * Returns a unique type name for this type
     *
     * @return string
     */
    public function getType()
    {
        return 'collection';
    }
}
