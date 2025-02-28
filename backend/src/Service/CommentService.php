<?php


namespace App\Service;


use App\Models\Comment;

class CommentService




{   

	public static function add($name,$content){
		$comment = new Comment($name,$content);
         
        Comment::save($comment);

				


				return $comment;
	}

	public static function delete($id){
		Comment::delete($data["id"]);
	}

	public static function getAll(){
		return Comment::all();
	}
}