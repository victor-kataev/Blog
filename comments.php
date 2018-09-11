<div class="create-comment">
    <form action="publish-comment.php" method="post">
        <fieldset class="form-group">
            <label for="new-comment" class="sr-only">New comment</label>
            <textarea class="form-control" name="new-comment" id="new-comment" placeholder="Leave a comment here"></textarea>
        </fieldset>
        <button type="submit" class="btn btn-success">Comment</button>
    </form>
</div>
<div class="comments">
    <?php
    use blog\comment\Comment;
    use blog\db\Db;

    require_once ('Db.php');
    require_once ('Comment.php');

        $db = Db::getInstance();
        $sql = "SELECT * FROM comment WHERE post_id = ".$_SESSION['post_id']." ORDER BY created DESC";
        $result = $db->sqlSelectQuery($sql);
        $comments = [];
        if($result) {
            while($row = $result->fetch()) {
                $comments[] = new Comment($row['id'], $row['content'], $row['created'], $row['user_id'], $row['post_id']);
            }

            foreach ($comments as $comment) {
                $comment->printComment();
            }
        } else {
            echo 'No comments yet';
        }

    ?>
</div>