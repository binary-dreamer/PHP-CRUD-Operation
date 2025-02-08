<?php
require_once './view/layout/header.php';
?>
<div class="container">
<form method="POST" action="index.php?action=<?php echo isset( $_GET['action'] ) && $_GET['action'] == 'create' ? "create" : "update"; ?>" enctype="multipart/form-data"> <!-- Ternary Operator (? :) -> Syntax- condition ? value_if_true : value_if_false -->
<input type="hidden" id="id" name="id" required value="<?php echo isset( $user['id'] ) ? $user['id'] : ''; ?>" >
    <br>

<!-- Show existing photo preview if available -->
<?php if (isset($user['photo']) && !empty($user['photo'])): ?>
    <img id="existingPhoto" 
         src="assets/images/<?php echo htmlspecialchars($user['photo']); ?>" 
         alt="Uploaded Photo" 
         style="width: 100px; height: 100px; object-fit: cover; margin-bottom: 10px;"><br>
<?php endif; ?>

<!-- New photo preview -->
<img id="newPhotoPreview" 
     alt="New Photo Preview" 
     style="display: none; width: 100px; height: 100px; object-fit: cover; margin-top: 10px;"> <br>

<!-- File input to select a new photo -->
<input type="file" name="photo" id="photo" onchange="previewNewPhoto(this)">

<!-- Hidden input to keep the old photo -->
<?php if (isset($user['photo']) && !empty($user['photo'])): ?>
    <input type="hidden" name="existing_photo" value="<?php echo htmlspecialchars($user['photo']); ?>">
<?php endif; ?>




<div class="mb-3">
    <label for="email" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" aria-describedby="nameHelp" name="name" required value="<?php echo isset( $user['name'] ) ? $user['name'] : ''; ?>" >
  </div>
  <div class="mb-3">
  <lable for="gender">Gender</lable><br>
<input type="radio" name="gender" value="female"  <?php echo (isset( $user['gender'])  && $user['gender'] == 'female') ? 'checked' : ''; ?>>Female<br>
<input type="radio" name="gender" value="male" <?php echo (isset( $user['gender'])  && $user['gender'] == 'male') ? 'checked' : ''; ?>>Male
 </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" required value="<?php echo isset( $user['email'] ) ? $user['email'] : ''; ?>" >
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  
  <button type="submit" class="btn btn-primary"><?php echo isset( $_GET['action']  ) && $_GET['action'] == 'create' ? "Insert" : "Update"; ?></button>
</form>
</div><br><br>

