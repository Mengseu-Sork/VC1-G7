<?php
$user = $_SESSION['user'] ?? null;
?>
<button
    type="button"
    aria-haspopup="true"
    aria-expanded="false"
    onclick="toggleProfile()"
    class="block transition-opacity duration-200 rounded-full dark:opacity-75 dark:hover:opacity-100 focus:outline-none focus:ring dark:focus:opacity-100">
    <span class="sr-only">User menu</span>
    <a href="/profile">
        <div class="relative inline-block">
            <!-- Profile Image -->
            <img class="w-10 h-10 rounded-full object-cover"
                src="<?php echo '/Assets/images/uploads/' . htmlspecialchars($user['image'] ?? 'default.png'); ?>" alt="Profile"/>

            <!-- Active Indicator -->
            <?php if ($user['active'] == 1): ?>
                <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-1 border-white rounded-full"></div>
            <?php else: ?>
                <div class="w-0 h-0 "></div>
            <?php endif; ?>
        </div>
    </a>
</button>

<!-- Hidden profile menu -->
<div id="profile-menu" class="">
    <a href="/profile/profile" class=""></a>
</div>

<script>
  function toggleProfile() {
    const profileMenu = document.getElementById('profile-menu');
    const button = document.querySelector("button[aria-haspopup='true']");
    
    const isHidden = profileMenu.classList.toggle('hidden'); 
    button.setAttribute("aria-expanded", !isHidden);
  }
</script>  
