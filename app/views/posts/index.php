<?php require APPROOT . '/views/inc/header.php';?>
    <?php flash('post_added')?>
    <?php flash('post_deleted')?>
    <?php flash('post_edited')?>
    <div class="row mt-3 mb-3 bg-light">
        <div class="col-md-6">
            <h1 class="display-4">Posts</h1>
        </div>
        <div class="col-md-6">
            <a href="<?php echo URLROOT ?>/posts/add" class="btn btn-info btn-sm float-right"><i class="fas fa-pencil-alt"></i> Add Post</a>
        </div>
    </div>

    <?php foreach ($data['Posts'] as $post): ?>
        <div class="card card-body mb-2">
            <h4 class="card-title"><?php echo $post->title ?></h4>
            <div class="bg-light p-2 mb-2">
                Written by: <?php echo $post->name ?> at <?php echo $post->postCrated ?>
            </div>
            <p class="card-text">
                <?php echo $post->body; ?>
            </p>
            <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId ?>" class="btn btn-dark">More...</a>
        </div>
    <?php endforeach;?>
<?php require APPROOT . '/views/inc/footer.php';?>
