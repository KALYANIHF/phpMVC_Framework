<?php require APPROOT . '/views/inc/header.php';?>
    <a class="btn btn-dark btn-sm mt-3" href="<?php echo URLROOT ?>/posts"><i class="fas fa-backward"></i> Back</a>
    <br>
    <h1><?php echo $data['post']->title ?></h1>
    <div class="bg-secondary text-white p-2 mb-3">
        Written By <?php echo $data['user']->name ?> on <?php echo $data['post']->created_at ?>
    </div>
    <p class="display-4"><?php echo $data['post']->body; ?></p>
    <?php if ($data['post']->user_id == $_SESSION['user_id']): ?>
        <hr>
        <a href="<?php echo URLROOT ?>/posts/edit/<?php echo $data['post']->id ?>" class="btn btn-dark">Edit</a>
        <form class="float-right" action="<?php echo URLROOT ?>/posts/delete/<?php echo $data['post']->id; ?>" method="post">
            <input type="submit" value="Delete" class="btn btn-danger">
        </form>
    <?php endif;?>
<?php require APPROOT . '/views/inc/header.php';?>
