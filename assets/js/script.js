function previewNewPhoto(input) {
    const newPhotoPreview = document.getElementById('newPhotoPreview');
    const existingPhoto = document.getElementById('existingPhoto');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        // When the file is read successfully
        reader.onload = function (e) {
            newPhotoPreview.src = e.target.result;
            newPhotoPreview.style.display = 'block'; // Show the new photo preview
            if (existingPhoto) {
                existingPhoto.style.display = 'none'; // Hide the existing photo preview
            }
        };
        
        reader.readAsDataURL(input.files[0]); // Read the selected file
    }
}
