
            <div class="container mx-auto mt-6 px-4">
              <a href="/user/create" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
                Add User
              </a>
                <div class="overflow-x-auto bg-white shadow-lg rounded-lg mt-5">
                    <table class="w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-800 text-white uppercase text-xs sm:text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Profile</th>
                                <th class="py-3 px-6 text-left">First Name</th>
                                <th class="py-3 px-6 text-left">Last Name</th>
                                <th class="py-3 px-6 text-left">Email</th>
                                <th class="py-3 px-6 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            <?php foreach ($users as $index => $user): ?>
                                <tr class="border-t border-gray-200 hover:bg-gray-100 transition duration-200">
                                    <td class="py-3 px-6 text-center">
                                      <img src="../../Assets/images/user/<?= $user["image"]?>" alt=""  width="30" height="30" style="border-radius: 10px;"  >
                                    </td>
                                    <td class="py-3 px-6"><?= $user['FirstName'] ?></td>
                                    <td class="py-3 px-6"><?= $user['LastName'] ?></td>
                                    <td class="py-3 px-6"><?= $user['email'] ?></td>
                                    <td class="py-3 px-6 text-center relative">
                                        <button onclick="toggleMenu(<?= $user['id'] ?>)">
                                            <i class="fas fa-ellipsis-v cursor-pointer"></i>
                                        </button>

                                        <!-- Dropdown Menu (Left-aligned) -->
                                        <div id="menu-<?= $user['id'] ?>" 
                                            class="absolute left-0 mt-2 w-32 bg-white border rounded-lg shadow-lg hidden">
                                            <a href="/user/edit?id=<?= $user['id'] ?>" 
                                              class="block px-4 py-2 text-gray-700 hover:bg-yellow-200 flex items-center">
                                                <i class="far fa-edit mr-2"></i> Edit
                                            </a>
                                            <button onclick="openModal('deleteUserModal<?= $user['id'] ?>')" 
                                                    class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-red-200 flex items-center">
                                                <i class="fas fa-trash-alt mr-2"></i> Delete
                                            </button>
                                        </div>
                                    </td>
                                  <!-- Delete Confirmation Modal -->
                                  <div id="deleteUserModal<?= $user['id'] ?>" 
                                      class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                                      <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                                          <h2 class="text-lg font-semibold">Delete User</h2>
                                          <p class="mt-4">Are you sure you want to delete this user?</p>

                                          <div class="mt-6 flex justify-end space-x-2">
                                              <button onclick="closeModal('deleteUserModal<?= $user['id'] ?>')"
                                                  class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400 transition duration-200">
                                                  Cancel
                                              </button>

                                              <form action="/user/delete?id=<?= $user['id'] ?>" method="POST">
                                                  <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                  <button type="submit"
                                                      class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-200">
                                                      Delete
                                                  </button>
                                              </form>
                                          </div>
                                      </div>
                                  </div>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
<script>
    function toggleMenu(userId) {
        var menu = document.getElementById("menu-" + userId);

        // Close all other menus first
        document.querySelectorAll('[id^="menu-"]').forEach(function(el) {
            if (el.id !== "menu-" + userId) {
                el.classList.add("hidden");
            }
        });

        // Toggle current menu
        menu.classList.toggle("hidden");
    }

    // Close menu if clicked outside
    document.addEventListener("click", function(event) {
        if (!event.target.closest("td")) {
            document.querySelectorAll('[id^="menu-"]').forEach(function(el) {
                el.classList.add("hidden");
            });
        }
    });
</script>