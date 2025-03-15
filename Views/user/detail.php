
<div class="container mx-auto mt-6 p-6 bg-white shadow-lg rounded-lg">
    <h3 class="text-2xl font-semibold mb-4">User Details</h3>
    <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
        <tr class="border-b">
            <th class="p-3 text-left bg-gray-100">Profile</th>
            <td class="p-3">
                <img src="/Assets/images/<?= $user['image'] ?>" alt="Profile Image" 
                     class="w-10 h-10 rounded-full border border-gray-300">
            </td>
        </tr>
        <tr class="border-b">
            <th class="p-3 text-left bg-gray-100">Name</th>
            <td class="p-3"><?= $user['FirstName']?> <?= $user['LastName']?></td>
        </tr>
        <tr class="border-b">
            <th class="p-3 text-left bg-gray-100">Email</th>
            <td class="p-3"><?= $user['email']; ?></td>
        </tr>
    </table>
    <a href="/" class="inline-block mt-4 px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">
        Back
    </a>
</div>
