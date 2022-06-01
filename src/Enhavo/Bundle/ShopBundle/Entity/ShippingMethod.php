<?php

namespace Enhavo\Bundle\ShopBundle\Entity;

use Sylius\Component\Shipping\Model\ShippingMethod as BaseShippingMethod;
use Sylius\Component\Taxation\Model\TaxCategoryInterface;

class ShippingMethod extends BaseShippingMethod
{
    protected ?TaxCategoryInterface $taxCategory;
    protected ?string $name;

    public function getTaxCategory(): ?TaxCategoryInterface
    {
        return $this->taxCategory;
    }

    public function setTaxCategory(?TaxCategoryInterface $taxCategory): void
    {
        $this->taxCategory = $taxCategory;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }
}