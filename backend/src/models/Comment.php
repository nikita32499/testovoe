<?php
 
namespace App\Models;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="comments")
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="integer")
     */
    private $createdAt;

    public function __construct() {
        $this->createdAt = time();
    }

    // Геттеры и сеттеры
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

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