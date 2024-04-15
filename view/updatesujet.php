<?php
include '../controller/sujetc.php';
$db = config::getConnexion();
$sujetController = new sujetController($db);


    // Mise à jour du poste
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_sujet'])) {
        $updatePostTitle = $_POST['update_post_title'];
        $updatePostContent = $_POST['update_post_content'];

        try {
            $postController->updatePost($postId, $updatePostTitle, $updatePostContent);
            echo 'Post updated successfully!';
        } catch (Exception $e) {
            echo 'Error updating post: ' . $e->getMessage();
        }
    }
 else {
    echo 'Post ID not provided';
    exit;
}
?>

<!DOCTPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post - Le Doc Forum</title>
    <link rel="stylesheet" href="forum.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <h1>Edit Post</h1>
        <<<<<<< HEAD <form action="../../ala/View/backoffice.php" method="post">
            =======
            <form action="" method="post">
                >>>>>>> 7079dccf7510ba6bb039e4986b441d5757f0cdab
                <label for="update_post_title">New Post Title:</label>
                <input type="text" id="update_post_title" name="update_post_title"
                    value="<?= htmlspecialchars($post['titre']) ?>"><br><br>

                <label for="update_post_content">New Post Content:</label>
                <textarea id="update_post_content" name="update_post_content"
                    rows="4"><?= htmlspecialchars($post['contenu']) ?></textarea><br><br>

                <input type="submit" name="update_post" value="Update Post">
            </form>
    </div>
</body>

</html>