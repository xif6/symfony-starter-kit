<?php

namespace Anaxago\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity()
 * @ORM\Table(
 *    uniqueConstraints={
 *        @ORM\UniqueConstraint(
 *            columns={"investor_id", "project_id"})
 *    }
 * )
 */
class ProjectUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"anonymous", "investor"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="projectUsers")
     */
    private $investor;

    /**
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="projectUsers")
     */
    private $project;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"investor"})
     */
    private $amount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvestor(): ?User
    {
        return $this->investor;
    }

    public function setInvestor(?User $investor): self
    {
        $this->investor = $investor;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
