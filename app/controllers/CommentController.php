<?php
require_once 'app/helpers/Database.php';
require_once 'config/config.php';
require_once 'app/models/Comment.php';
require_once 'app/helpers/DbHelper.php';

/**
 * Class CommentController - handles comments functionality.
 */
class CommentController {

    /**
     * Creates a new comment.
     *
     * @return void
     */
    public function create(): void {
        $comment = new Comment();
        $comment->name = $_POST['name'];
        $comment->email = $_POST['email'];
        $comment->title = $_POST['title'];
        $comment->description = $_POST['description'];

        $values = [$comment->name, $comment->email, $comment->title, $comment->description ];
        $errors = [];

        foreach ($comment->fields as $field) {
            if (empty($_POST[$field])) {
                $errors[] = ucfirst($field) . ' is required';
            }
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email format';
        }
        if (strlen($_POST['name']) < 2 || strlen($_POST['name']) > 50) {
            $errors[] = 'Name must be between 2 and 50 characters long';
        }

        if (!empty($errors)) {
            echo '<ul>';
            foreach ($errors as $error) {
                echo '<li>' . $error . '</li>';
            }
            echo '</ul>';
        } else {
            $comment->data = $comment->save($comment->fields, $values);
            echo  json_encode($comment);
        }
    }

    /**
     * Deletes a comment.
     *
     * @return void
     */
    public function delete(): void {
        $comment = new Comment();
        $comment->delete($_POST['commentId']);
    }
}