<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */

class Articles
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @@ORM\Column(type="string")
     *
     */     private $title;


    /**
     *@ORM\Column(type="string",length=300)
     *
     */      private $content;

    /**
     *@ORM\Column(type="string")
     *
     */
    private $image;

    /**
     * @ORM\Column(type="date", name="date_publication")
     */
    private $date;

    /**
     * @ORM\Column(type="boolean", name="published")
     */
    private $published;


}