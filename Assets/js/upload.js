function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function () {
            const img = document.getElementById("preview");
            img.src = reader.result;
            img.classList.remove("hidden");
        };
        reader.readAsDataURL(file);
    }
}

function openModal(id) {
    document.getElementById(id).classList.remove("hidden");
    }

function closeModal(id) {
    document.getElementById(id).classList.add("hidden");
    }
