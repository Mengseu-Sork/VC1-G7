<div class="modal fade" id="user<?= $user['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog flex justify-center items-center">
        <div class="modal-content bg-white rounded-lg shadow-lg max-w-lg w-full">
            <div class="modal-header flex justify-between items-center p-4 border-b border-gray-200">
                <h5 class="modal-title text-xl font-semibold text-gray-800" id="exampleModalLabel">Delete User</h5>
                <button type="button" class="btn-close text-gray-600 hover:text-gray-800" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body p-4 text-gray-700">
                Are you sure you want to delete this user?.
            </div>
            <div class="modal-footer p-4 border-t border-gray-200">
                <form action="/user/delete?id=<?= $user['id'] ?>" method="POST" class="flex space-x-4">
                    <button type="submit" class="btn btn-danger px-6 py-2 text-white bg-red-600 hover:bg-red-500 rounded-md focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-50">
                        Delete
                    </button>
                    <button type="button" class="btn btn-secondary px-6 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50" data-bs-dismiss="modal">
                        Discard
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
