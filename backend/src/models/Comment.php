<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['image_id', 'content'];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    private $id;
    private $content;

    public function __construct($id, $content) {
        $this->id = $id;
        $this->content = $content;
    }

    public function getId() {
        return $this->id;
    }

    public function getContent() {
        return $this->content;
    }

    public static function save($content) {
        // Логика для сохранения комментария в базу данных
    }

    public static function delete($id) {
        // Логика для удаления комментария из базы данных
    }
} 