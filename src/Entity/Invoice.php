<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity(repositoryClass=InvoiceRepository::class)
 * @ApiResource(
 *  itemOperations = {
 *      "put",
 *      "delete",
 *      "get" = {
 *          "normalization_context"={"groups"="read:invoice:item"}
 *      }
 *  },
 *  collectionOperations = {
 *      "post",
 *      "get" = {
 *          "normalization_context"={"groups"="read:invoice:collection"}
 *      }
 *  }
 * )
 * @ApiFilter(DateFilter::class, properties={"sendingAt"})
 */
class Invoice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *  @Groups({"read:customer:item",
     * "read:invoice:collection",
     * "read:invoice:item"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"read:customer:item",
     * "read:invoice:collection",
     * "read:invoice:item"
     * })
     */
    private $amount;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read:customer:item",
     * "read:invoice:collection",
     * "read:invoice:item"
     * })
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"read:customer:item",
     * "read:invoice:collection",
     * "read:invoice:item"
     * })
     */
    private $endingAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read:customer:item",
     * "read:invoice:collection",
     * "read:invoice:item"
     * })
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="invoices")
     * @Groups({"read:invoice:collection",
     * "read:invoice:item"
     * })
     */
    private $customer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(?int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getEndingAt(): ?\DateTimeInterface
    {
        return $this->endingAt;
    }

    public function setEndingAt(?\DateTimeInterface $endingAt): self
    {
        $this->endingAt = $endingAt;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }
}
