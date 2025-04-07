<?php
$user = $_SESSION['user'] ?? null;
?>
<button
    type="button"
    aria-haspopup="true"
    aria-expanded="false"
    onclick="toggleProfile()"
    class="block transition-opacity duration-200 rounded-full border-b dark:border-primary-darker dark:opacity-75 dark:hover:opacity-100 focus:outline-none focus:ring dark:focus:opacity-100">
    <span class="sr-only">User menu</span>
    <a href="/user/profile"> <img class="w-10 h-10 rounded-full" 
      src="<?php echo '/Assets/images/uploads/' . htmlspecialchars($user['image'] ?? 'default.png'); ?>" alt="Profile"/></a>
</button>

<!-- Hidden profile menu -->
<div id="profile-menu" class="">
    <a href="/user/profile" class=""></a>
</div>

<script>
  function toggleProfile() {
    const profileMenu = document.getElementById('profile-menu');
    const button = document.querySelector("button[aria-haspopup='true']");
    
    const isHidden = profileMenu.classList.toggle('hidden'); 
    button.setAttribute("aria-expanded", !isHidden);
  }
</script>  
