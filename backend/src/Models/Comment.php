<?php
 
namespace App\Models;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="comments")
 */
class Comment
{


    function __construct($name,$content) {
        $this->content = $content;
        $this->name = $name;
        $this->createdAt = time();
    }

    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string")
     */
    public $name;

    /**
     * @ORM\Column(type="text")
     */
    public $content;

    /**
     * @ORM\Column(type="integer")
     */
    public $createdAt;

    

    // Геттеры и сеттеры
    

    // Статические методы для работы с БД
    public static function save($comment) {
        global $entityManager;
        $entityManager->persist($comment);
        $entityManager->flush();
    }

    public static function delete($id) {
        global $entityManager;
        $comment = $entityManager->find(self::class, $id);
        if ($comment) {
            $entityManager->remove($comment);
            $entityManager->flush();
        }
    }

    public static function find($id) {
        global $entityManager;
        return $entityManager->find(self::class, $id);
    }

    public static function all() {
        global $entityManager;
        return $entityManager->getRepository(self::class)->findAll();
    }
}