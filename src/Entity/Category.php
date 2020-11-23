<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */

class Category
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
     *@ORM\Column(type="string")
     *
     */      private $color;

     /**
     * @ORM\Column(type="date", name="date_publication")
     */
            private $date;

    /**
     * @ORM\Column(type="datetime", name="created")
     */
            private $created;

    /**
     * @ORM\Column(type="boolean", name="published")
     */
            private $published;



}