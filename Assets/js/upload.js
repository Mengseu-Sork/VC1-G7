
function openModal(id) {
    document.getElementById(id).classList.remove("hidden");
    }

function closeModal(id) {
    document.getElementById(id).classList.add("hidden");
    }

    
    document.getElementById('imageInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    function previewImage(input) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const imgPreview = document.getElementById('image-preview');
            imgPreview.src = e.target.result;
            imgPreview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
        }
    }

    document.getElementById('togglePassword').addEventListener('click', function() {
        var passwordField = document.getElementById('password');
        var currentType = passwordField.type;
        passwordField.type = currentType === 'password' ? 'text' : 'password';
    });
