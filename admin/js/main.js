$(document).ready(function() {
  // Animated header setup
  const header = $('.animated-header');
  header.attr('data-text', header.text().trim());
  header.text('');
  
  // Product search functionality
  $('#search-input').on('input', function() {
      const searchTerm = $(this).val().toLowerCase().trim();
      
      if (searchTerm === '') {
          $('.product-item').show();
          return;
      }
      
      $('.product-item').each(function() {
          const $item = $(this);
          const name = $item.data('name');
          const description = $item.data('description');
          
          if (name.includes(searchTerm) || description.includes(searchTerm)) {
              $item.show();
          } else {
              $item.hide();
          }
      });
  });
  
  // Like/Dislike functionality
  $(document).on('click', '.like-btn', function() {
      const $likeBtn = $(this);
      const $dislikeBtn = $likeBtn.closest('.like-dislike-container').find('.dislike-btn');
      
      $likeBtn.toggleClass('liked');
      if ($likeBtn.hasClass('liked')) {
          $likeBtn.html('<i class="fas fa-heart"></i> Liked');
          $dislikeBtn.removeClass('disliked');
          $dislikeBtn.html('<i class="far fa-thumbs-down"></i> Dislike');
      } else {
          $likeBtn.html('<i class="far fa-heart"></i> Like');
      }
  });
  
  $(document).on('click', '.dislike-btn', function() {
      const $dislikeBtn = $(this);
      const $likeBtn = $dislikeBtn.closest('.like-dislike-container').find('.like-btn');
      
      $dislikeBtn.toggleClass('disliked');
      if ($dislikeBtn.hasClass('disliked')) {
          $dislikeBtn.html('<i class="fas fa-thumbs-down"></i> Disliked');
          $likeBtn.removeClass('liked');
          $likeBtn.html('<i class="far fa-heart"></i> Like');
      } else {
          $dislikeBtn.html('<i class="far fa-thumbs-down"></i> Dislike');
      }
  });
  
  // Buy button functionality
  $(document).on('click', '.buy-btn', function() {
      const $btn = $(this);
      const $checkmark = $btn.closest('.card-body').find('.checkmark');
      
      $btn.prop('disabled', true);
      $btn.text('Buying...');
      $checkmark.text('✓');
      
      // Simulate purchase process
      setTimeout(() => {
          $btn.text('Purchased');
          $btn.removeClass('btn-success').addClass('btn-secondary');
      }, 1500);
  });
});