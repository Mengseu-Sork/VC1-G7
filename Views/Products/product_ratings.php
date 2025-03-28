<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Reviews</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="mx-auto flex-1 h-full overflow-x-hidden overflow-y-auto">
        <div class="container mx-auto px-4 py-8 max-w-6xl">
            <!-- Header with Back Button -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Customer Reviews</h2>
                <?php if (isset($_GET['id'])): ?>
                    <a href="/products/details?id=<?php echo htmlspecialchars($_GET['id']); ?>" class="flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition-colors">
                        <i class="fas fa-arrow-left"></i>
                        Back to Product Details
                    </a>
                <?php else: ?>
                    <a href="/products" class="flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition-colors">
                        <i class="fas fa-arrow-left"></i>
                        Back to Products
                    </a>
                <?php endif; ?>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Sidebar -->
                <div class="md:col-span-1 space-y-6">
                    <!-- Write Review Button -->
                    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                        <button
                            id="openModalBtn"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded transition-colors"
                        >
                            Write a Review
                        </button>
                    </div>
                    
                    <!-- Rating Histogram -->
                    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                        <h3 class="font-medium text-gray-700 mb-4">Rating Distribution</h3>
                        
                        <div id="rating-histogram">
                            <!-- 5 stars -->
                            <div class="flex items-center mb-2">
                                <div class="w-10 text-sm font-medium">5 ★</div>
                                <div class="flex-1 mx-2 h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-yellow-400 rounded-full" style="width: 0%"></div>
                                </div>
                                <div class="w-10 text-sm text-right">0%</div>
                            </div>
                            
                            <!-- 4 stars -->
                            <div class="flex items-center mb-2">
                                <div class="w-10 text-sm font-medium">4 ★</div>
                                <div class="flex-1 mx-2 h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-yellow-400 rounded-full" style="width: 0%"></div>
                                </div>
                                <div class="w-10 text-sm text-right">0%</div>
                            </div>
                            
                            <!-- 3 stars -->
                            <div class="flex items-center mb-2">
                                <div class="w-10 text-sm font-medium">3 ★</div>
                                <div class="flex-1 mx-2 h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-yellow-400 rounded-full" style="width: 0%"></div>
                                </div>
                                <div class="w-10 text-sm text-right">0%</div>
                            </div>
                            
                            <!-- 2 stars -->
                            <div class="flex items-center mb-2">
                                <div class="w-10 text-sm font-medium">2 ★</div>
                                <div class="flex-1 mx-2 h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-yellow-400 rounded-full" style="width: 0%"></div>
                                </div>
                                <div class="w-10 text-sm text-right">0%</div>
                            </div>
                            
                            <!-- 1 star -->
                            <div class="flex items-center mb-2">
                                <div class="w-10 text-sm font-medium">1 ★</div>
                                <div class="flex-1 mx-2 h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-yellow-400 rounded-full" style="width: 0%"></div>
                                </div>
                                <div class="w-10 text-sm text-right">0%</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Reviews List -->
                <div class="md:col-span-2">
                    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                        <!-- Reviews Header -->
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                            <div class="flex items-center gap-2" id="rating-summary">
                                <div class="flex">
                                    <i class="fas fa-star text-gray-300"></i>
                                    <i class="fas fa-star text-gray-300"></i>
                                    <i class="fas fa-star text-gray-300"></i>
                                    <i class="fas fa-star text-gray-300"></i>
                                    <i class="fas fa-star text-gray-300"></i>
                                </div>
                                <span class="font-medium">0.0</span>
                                <span class="text-gray-500">(0 reviews)</span>
                            </div>
                            
                            <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                                <div class="flex items-center gap-2">
                                    <label for="filter" class="text-sm text-gray-600">Filter:</label>
                                    <select
                                        id="filter"
                                        class="border border-gray-300 rounded px-2 py-1 text-sm"
                                    >
                                        <option value="all">All Ratings</option>
                                        <option value="5">5 Stars</option>
                                        <option value="4">4 Stars</option>
                                        <option value="3">3 Stars</option>
                                        <option value="2">2 Stars</option>
                                        <option value="1">1 Star</option>
                                    </select>
                                </div>
                                
                                <div class="flex items-center gap-2">
                                    <label for="sort" class="text-sm text-gray-600">Sort by:</label>
                                    <select
                                        id="sort"
                                        class="border border-gray-300 rounded px-2 py-1 text-sm"
                                    >
                                        <option value="newest">Newest</option>
                                        <option value="oldest">Oldest</option>
                                        <option value="highest">Highest Rating</option>
                                        <option value="lowest">Lowest Rating</option>
                                        <option value="helpful">Most Helpful</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Reviews List -->
                        <div id="reviews-container" class="space-y-6">
                            <div class="text-center py-8">
                                <p class="text-gray-500">No reviews yet. Be the first to leave a review!</p>
                            </div>
                        </div>
                        
                        <!-- Pagination - simplified for this example -->
                        <div id="pagination" class="flex justify-between items-center mt-8 hidden">
                            <button class="flex items-center gap-1 text-gray-600 hover:text-gray-900">
                                <i class="fas fa-chevron-left text-xs"></i>
                                <span>Previous</span>
                            </button>
                            
                            <div class="flex items-center gap-2">
                                <button class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-800 text-white">1</button>
                                <button class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100">2</button>
                                <button class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100">3</button>
                            </div>
                            
                            <button class="flex items-center gap-1 text-gray-600 hover:text-gray-900">
                                <span>Next</span>
                                <i class="fas fa-chevron-right text-xs"></i>
                            </button>
                        </div>
                        
                        <!-- Back to Product Button (Mobile) -->
                        <div class="mt-8 md:hidden">
                            <?php if (isset($_GET['id'])): ?>
                                <a href="/products/details?id=<?php echo htmlspecialchars($_GET['id']); ?>" class="flex items-center justify-center gap-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition-colors w-full">
                                    <i class="fas fa-arrow-left"></i>
                                    Back to Product Details
                                </a>
                            <?php else: ?>
                                <a href="/products" class="flex items-center justify-center gap-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition-colors w-full">
                                    <i class="fas fa-arrow-left"></i>
                                    Back to Products
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Review Modal -->
            <div id="reviewModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
                <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
                    <div class="flex justify-between items-center p-6 border-b">
                        <h3 class="text-xl font-medium">Write a Review</h3>
                        <button id="closeModalBtn" class="text-gray-400 hover:text-gray-500">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    
                    <div class="p-6">
                        <div class="mb-6">
                            <label class="block mb-2 font-medium">Your Rating</label>
                            <div id="star-rating" class="flex items-center gap-2">
                                <div class="flex">
                                    <i class="far fa-star text-2xl cursor-pointer" data-rating="1"></i>
                                    <i class="far fa-star text-2xl cursor-pointer" data-rating="2"></i>
                                    <i class="far fa-star text-2xl cursor-pointer" data-rating="3"></i>
                                    <i class="far fa-star text-2xl cursor-pointer" data-rating="4"></i>
                                    <i class="far fa-star text-2xl cursor-pointer" data-rating="5"></i>
                                </div>
                                <span id="rating-text" class="ml-2 text-sm text-gray-600">Select a rating</span>
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <label for="review-title" class="block mb-2 font-medium">Review Title</label>
                            <input
                                id="review-title"
                                type="text"
                                placeholder="Summarize your experience"
                                class="w-full border border-gray-300 rounded-md px-3 py-2"
                            />
                        </div>
                        
                        <div class="mb-6">
                            <label for="review-content" class="block mb-2 font-medium">Your Review</label>
                            <textarea
                                id="review-content"
                                placeholder="What did you like or dislike about this product?"
                                rows="5"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 resize-none"
                            ></textarea>
                        </div>
                        
                        <div class="text-sm text-gray-500 mb-6">
                            By submitting this review, you agree to our terms of service and privacy policy.
                        </div>
                        
                        <div class="flex gap-3">
                            <button
                                id="submitReviewBtn"
                                class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded transition-colors"
                            >
                                Submit Review
                            </button>
                            <button
                                id="discardBtn"
                                class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded transition-colors"
                            >
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Store product ID from URL for use in reviews
            const urlParams = new URLSearchParams(window.location.search);
            const productId = urlParams.get('id');
            
            // DOM Elements
            const openModalBtn = document.getElementById('openModalBtn');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const discardBtn = document.getElementById('discardBtn');
            const reviewModal = document.getElementById('reviewModal');
            const submitReviewBtn = document.getElementById('submitReviewBtn');
            const reviewTitle = document.getElementById('review-title');
            const reviewContent = document.getElementById('review-content');
            const starRating = document.getElementById('star-rating');
            const stars = starRating.querySelectorAll('i');
            const ratingText = document.getElementById('rating-text');
            const reviewsContainer = document.getElementById('reviews-container');
            const filterSelect = document.getElementById('filter');
            const sortSelect = document.getElementById('sort');
            const pagination = document.getElementById('pagination');
            
            // State
            let selectedRating = 0;
            let currentFilter = 'all';
            let currentSort = 'newest';
            
            // Rating text options
            const ratingTexts = [
                'Select a rating',
                'Poor',
                'Fair',
                'Average',
                'Good',
                'Excellent'
            ];
            
            // Modal functionality
            openModalBtn.addEventListener('click', () => {
                reviewModal.classList.remove('hidden');
            });
            
            closeModalBtn.addEventListener('click', () => {
                reviewModal.classList.add('hidden');
                resetForm();
            });
            
            discardBtn.addEventListener('click', () => {
                reviewModal.classList.add('hidden');
                resetForm();
            });
            
            // Close modal when clicking outside
            window.addEventListener('click', (e) => {
                if (e.target === reviewModal) {
                    reviewModal.classList.add('hidden');
                    resetForm();
                }
            });
            
            // Star rating functionality
            stars.forEach(star => {
                star.addEventListener('mouseover', () => {
                    const rating = parseInt(star.getAttribute('data-rating'));
                    updateStars(rating);
                    ratingText.textContent = ratingTexts[rating];
                });
                
                star.addEventListener('mouseout', () => {
                    updateStars(selectedRating);
                    ratingText.textContent = ratingTexts[selectedRating];
                });
                
                star.addEventListener('click', () => {
                    selectedRating = parseInt(star.getAttribute('data-rating'));
                    updateStars(selectedRating);
                    ratingText.textContent = ratingTexts[selectedRating];
                });
            });
            
            function updateStars(rating) {
                stars.forEach(s => {
                    const starRating = parseInt(s.getAttribute('data-rating'));
                    if (starRating <= rating) {
                        s.classList.remove('far');
                        s.classList.add('fas');
                        s.classList.add('text-yellow-400');
                    } else {
                        s.classList.remove('fas');
                        s.classList.add('far');
                        s.classList.remove('text-yellow-400');
                    }
                });
            }
            
            // Submit review
            submitReviewBtn.addEventListener('click', function() {
                const title = reviewTitle.value.trim();
                const content = reviewContent.value.trim();
                
                // Validate form
                if (selectedRating === 0) {
                    alert('Please select a rating');
                    return;
                }
                
                if (title === '') {
                    alert('Please enter a review title');
                    return;
                }
                
                if (content === '') {
                    alert('Please enter your review');
                    return;
                }
                
                // Create review object
                const review = {
                    id: Date.now(), // Unique ID based on timestamp
                    productId: productId, // Store the product ID with the review
                    rating: selectedRating,
                    title: title,
                    content: content,
                    customerName: 'Customer', // You can replace this with actual user name if available
                    verified: true,
                    date: new Date().toISOString(),
                    helpful: 0,
                    notHelpful: 0
                };
                
                // Save to localStorage
                saveReview(review);
                
                // Close modal and reset form
                reviewModal.classList.add('hidden');
                resetForm();
                
                // Refresh reviews display
                displayReviews();
            });
            
            // Reset form
            function resetForm() {
                reviewTitle.value = '';
                reviewContent.value = '';
                selectedRating = 0;
                updateStars(0);
                ratingText.textContent = ratingTexts[0];
            }
            
            // Save review to localStorage
            function saveReview(review) {
                // Get existing reviews or initialize empty array
                let reviews = JSON.parse(localStorage.getItem('productReviews')) || [];
                
                // Add new review
                reviews.push(review);
                
                // Save back to localStorage
                localStorage.setItem('productReviews', JSON.stringify(reviews));
            }
            
            // Load reviews from localStorage
            function loadReviews() {
                let reviews = JSON.parse(localStorage.getItem('productReviews')) || [];
                
                // Filter by product ID if available
                if (productId) {
                    reviews = reviews.filter(review => review.productId === productId);
                }
                
                return reviews;
            }
            
            // Filter and sort reviews
            function getFilteredAndSortedReviews() {
                let reviews = loadReviews();
                
                // Apply filter
                if (currentFilter !== 'all') {
                    const rating = parseInt(currentFilter);
                    reviews = reviews.filter(review => review.rating === rating);
                }
                
                // Apply sort
                switch (currentSort) {
                    case 'newest':
                        reviews.sort((a, b) => new Date(b.date) - new Date(a.date));
                        break;
                    case 'oldest':
                        reviews.sort((a, b) => new Date(a.date) - new Date(b.date));
                        break;
                    case 'highest':
                        reviews.sort((a, b) => b.rating - a.rating);
                        break;
                    case 'lowest':
                        reviews.sort((a, b) => a.rating - b.rating);
                        break;
                    case 'helpful':
                        reviews.sort((a, b) => b.helpful - a.helpful);
                        break;
                }
                
                return reviews;
            }
            
            // Display reviews
            function displayReviews() {
                const reviews = getFilteredAndSortedReviews();
                
                // Update pagination visibility
                if (reviews.length > 0) {
                    pagination.classList.remove('hidden');
                } else {
                    pagination.classList.add('hidden');
                }
                
                // Clear container
                reviewsContainer.innerHTML = '';
                
                if (reviews.length === 0) {
                    reviewsContainer.innerHTML = `
                        <div class="text-center py-8">
                            <p class="text-gray-500">No reviews yet. Be the first to leave a review!</p>
                        </div>
                    `;
                    return;
                }
                
                // Add reviews to container
                reviews.forEach(review => {
                    const date = new Date(review.date);
                    const formattedDate = date.toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                    
                    // Create stars HTML
                    let starsHTML = '';
                    for (let i = 1; i <= 5; i++) {
                        if (i <= review.rating) {
                            starsHTML += '<i class="fas fa-star text-yellow-400"></i>';
                        } else {
                            starsHTML += '<i class="fas fa-star text-gray-300"></i>';
                        }
                    }
                    
                    const reviewHTML = `
                        <div class="border-b border-gray-200 pb-6 last:border-0" data-id="${review.id}">
                            <div class="flex justify-between items-start">
                                <div class="flex">
                                    ${starsHTML}
                                </div>
                            </div>
                            
                            <h3 class="font-medium text-lg mt-2">${review.title}</h3>
                            
                            <div class="mt-1 mb-3">
                                <div class="font-medium">${review.customerName}</div>
                                ${review.verified ? '<div class="text-green-600 text-sm font-medium">Verified Purchase</div>' : ''}
                                <div class="text-gray-500 text-sm">${formattedDate}</div>
                            </div>
                            
                            <p class="text-gray-700 mb-4">${review.content}</p>
                            
                            <div class="flex justify-between items-center">
                                <div class="flex items-center gap-4">
                                    <span class="text-sm text-gray-500">Was this helpful?</span>
                                    <button 
                                        onclick="markHelpful(${review.id})"
                                        class="flex items-center gap-1 text-sm text-gray-600 hover:text-gray-900"
                                    >
                                        <i class="fas fa-thumbs-up"></i>
                                        <span>(${review.helpful})</span>
                                    </button>
                                    <button 
                                        onclick="markNotHelpful(${review.id})"
                                        class="flex items-center gap-1 text-sm text-gray-600 hover:text-gray-900"
                                    >
                                        <i class="fas fa-thumbs-down"></i>
                                        <span>(${review.notHelpful})</span>
                                    </button>
                                </div>
                                
                                <button 
                                    onclick="reportReview(${review.id})"
                                    class="text-sm text-gray-600 hover:text-gray-900"
                                >
                                    <i class="fas fa-flag"></i>
                                </button>
                            </div>
                        </div>
                    `;
                    
                    reviewsContainer.innerHTML += reviewHTML;
                });
                
                // Update review stats
                updateReviewStats();
            }
            
            // Update review statistics
            function updateReviewStats() {
                const allReviews = loadReviews();
                
                if (allReviews.length === 0) {
                    return;
                }
                
                // Calculate average rating
                const totalRating = allReviews.reduce((sum, review) => sum + review.rating, 0);
                const averageRating = totalRating / allReviews.length;
                
                // Update rating summary
                const ratingSummary = document.getElementById('rating-summary');
                
                // Create stars HTML
                let starsHTML = '';
                for (let i = 1; i <= 5; i++) {
                    if (i <= Math.round(averageRating)) {
                        starsHTML += '<i class="fas fa-star text-yellow-400"></i>';
                    } else {
                        starsHTML += '<i class="fas fa-star text-gray-300"></i>';
                    }
                }
                
                ratingSummary.innerHTML = `
                    <div class="flex">
                        ${starsHTML}
                    </div>
                    <span class="font-medium">${averageRating.toFixed(1)}</span>
                    <span class="text-gray-500">(${allReviews.length} reviews)</span>
                `;
                
                // Count ratings by star
                const ratingCounts = [0, 0, 0, 0, 0]; // 5 stars, 4 stars, 3 stars, 2 stars, 1 star
                allReviews.forEach(review => {
                    ratingCounts[5 - review.rating]++;
                });
                
                // Calculate percentages
                const ratingPercentages = ratingCounts.map(count => 
                    Math.round((count / allReviews.length) * 100)
                );
                
                // Update histogram
                const histogramBars = document.querySelectorAll('#rating-histogram .bg-yellow-400');
                const percentageTexts = document.querySelectorAll('#rating-histogram .text-right');
                
                for (let i = 0; i < 5; i++) {
                    histogramBars[i].style.width = `${ratingPercentages[i]}%`;
                    percentageTexts[i].textContent = `${ratingPercentages[i]}%`;
                }
            }
            
            // Filter change handler
            filterSelect.addEventListener('change', function() {
                currentFilter = this.value;
                displayReviews();
            });
            
            // Sort change handler
            sortSelect.addEventListener('change', function() {
                currentSort = this.value;
                displayReviews();
            });
            
            // Initialize reviews display
            displayReviews();
            
            // Make helper functions available globally
            window.markHelpful = function(reviewId) {
                let reviews = JSON.parse(localStorage.getItem('productReviews')) || [];
                const reviewIndex = reviews.findIndex(r => r.id === reviewId);
                
                if (reviewIndex !== -1) {
                    reviews[reviewIndex].helpful++;
                    localStorage.setItem('productReviews', JSON.stringify(reviews));
                    
                    // Update UI
                    const helpfulCount = document.querySelector(`[data-id="${reviewId}"] .fa-thumbs-up + span`);
                    if (helpfulCount) {
                        helpfulCount.textContent = `(${reviews[reviewIndex].helpful})`;
                    }
                }
            };
            
            window.markNotHelpful = function(reviewId) {
                let reviews = JSON.parse(localStorage.getItem('productReviews')) || [];
                const reviewIndex = reviews.findIndex(r => r.id === reviewId);
                
                if (reviewIndex !== -1) {
                    reviews[reviewIndex].notHelpful++;
                    localStorage.setItem('productReviews', JSON.stringify(reviews));
                    
                    // Update UI
                    const notHelpfulCount = document.querySelector(`[data-id="${reviewId}"] .fa-thumbs-down + span`);
                    if (notHelpfulCount) {
                        notHelpfulCount.textContent = `(${reviews[reviewIndex].notHelpful})`;
                    }
                }
            };
            
            window.reportReview = function(reviewId) {
                alert('Review reported. Thank you for your feedback.');
            };
        });
    </script>
</body>
</html>