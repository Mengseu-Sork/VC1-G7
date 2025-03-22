<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">  
    <title>Product Ratings and Reviews</title>  
</head>  
<body class="bg-gray-100">  

    <div class="container mx-auto p-8">  
        <h2 class="text-2xl font-bold mb-4">Customer Ratings and Reviews</h2>  

        <div class="flex items-center mb-4">  
            <span class="text-yellow-500 text-lg">&#9733;&#9733;&#9733;&#9733;&#9733;</span>  
            <span class="ml-2 text-gray-600">4.5/5 (150 Reviews)</span>  
        </div>  

        <div class="mb-4">  
            <label for="sort" class="block text-gray-700">Sort by:</label>  
            <select id="sort" class="mt-1 border border-gray-400 rounded p-2">  
                <option value="most_recent">Most Recent</option>  
                <option value="highest_rating">Highest Rating</option>  
            </select>  
        </div>  

        <div class="bg-white shadow-lg rounded-lg p-4 mb-6">  
            <h3 class="font-semibold text-lg mb-2">Customer Reviews:</h3>  
            <div class="mb-4">  
                <div class="flex items-center">  
                    <span class="text-yellow-500">&#9733;&#9733;&#9733;&#9733;&#9734;</span>  
                    <span class="ml-2 text-gray-600">John Doe - 2 days ago</span>  
                </div>  
                <p class="text-gray-700">Great product! It fits perfectly and looks amazing.</p>  
            </div>  
            <div class="mb-4">  
                <div class="flex items-center">  
                    <span class="text-yellow-500">&#9733;&#9733;&#9733;&#9733;&#9733;</span>  
                    <span class="ml-2 text-gray-600">Jane Smith - 1 week ago</span>  
                </div>  
                <p class="text-gray-700">Quality is excellent, very satisfied with my purchase!</p>  
            </div>  
            <!-- More reviews can be added here -->  
        </div>  

        <div class="bg-white shadow-lg rounded-lg p-4">  
            <h3 class="font-semibold text-lg mb-2">Leave a Review:</h3>  
            <form id="review-form">  
                <div class="mb-4">  
                    <label for="rating" class="block text-gray-700">Rating:</label>  
                    <select id="rating" class="mt-1 border border-gray-400 rounded p-2">  
                        <option value="5">5 Stars</option>  
                        <option value="4">4 Stars</option>  
                        <option value="3">3 Stars</option>  
                        <option value="2">2 Stars</option>  
                        <option value="1">1 Star</option>  
                    </select>  
                </div>  
                <div class="mb-4">  
                    <label for="review" class="block text-gray-700">Review:</label>  
                    <textarea id="review" rows="4" class="mt-1 border border-gray-400 rounded p-2" placeholder="Write your review..."></textarea>  
                </div>  
                <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-400">Submit Review</button>  
            </form>  
        </div>  
    </div>  

</body>  
</html>  