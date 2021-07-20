
<?php require APPROOT . '/views/inc/header.php';?>
        <a class="btn btn-dark btn-sm mt-3" href="<?php echo URLROOT ?>/posts"><i class="fas fa-backward"></i> Back</a>
          <div class="card card-body bg-light mt-2">
              <h2 class="display-4">Add Post</h2>
              <p>Create a Post with this form</p>
              <form action="<?php echo URLROOT ?>/posts/edit/<?php echo $data['id']; ?>" method="POST">

                <div class="form-group">
                    <label for="title">Title: <sup>*</sup></label>
                    <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err']) ? "is-invalid" : '') ?>" id="" value="<?php echo $data['title']; ?>">
                    <span class="invalid-feedback"><?php echo $data['title_err'] ?></span>
                </div>

                <div class="form-group">
                    <label for="body">body: <sup>*</sup></label>
                    <textarea name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err']) ? "is-invalid" : '') ?>" id=""><?php echo $data['body']; ?></textarea>
                    <span class="invalid-feedback"><?php echo $data['body_err'] ?></span>
                </div>
                <input type="submit" value="submit" class="btn btn-success">
              </form>
          </div>
<?php require APPROOT . '/views/inc/footer.php';?>
