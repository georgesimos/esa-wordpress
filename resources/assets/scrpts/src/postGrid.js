import 'masonry-layout/dist/masonry.pkgd.js';

class managePostGrid {

  constructor(container) {
    this.$container = $(container);
    this.$grid = $('.posts-grid', this.$container);
    this.$postsNav = $('.load-more-wrapper', this.$container);
    this.$moreButton = $('.btn-load-more', this.$postsNav);
    this.globals = window.esaGlobals;
    this.data = {
      action: 'esa_post_grid',
      offset: 0,
      nonce: this.globals.nonce,
      post_type: this.$container.data('post_type'),
      posts_per_page: this.$container.data('posts_per_page'),
      order: this.$container.data('order'),
      orderby: this.$container.data('orderby'),
      exclude: this.$container.data('exclude'),
    };

    this.init = this.init.bind(this);
    this.manageLoadMore = this.manageLoadMore.bind(this);

    this.init();
  }

  init() {
    this.$grid.masonry({
      itemSelector: '.grid-post',
    });

    this.manageLoadMore();
  }

  // Send ajax request
  getProducts() {
    this.$grid.addClass('loading');

    return $.ajax({
      method: 'POST',
      url: this.globals.ajax_url,
      dataType: 'json',
      data: this.data,
      success: () => {
        this.$grid.removeClass('loading');
      },
    });
  }

  // Handle load more items
  manageLoadMore() {
    this.$moreButton.on('click', (e) => {
      e.preventDefault();

      this.$moreButton.toggleClass('loading').attr('disabled', true);
      this.data.offset = $('.grid-post', this.$grid).length;
      let count = this.data.offset;

      const products = this.getProducts();

      products.success((response) => {
        if ( response.success ) {
          const $elems = $(response.data.html);
          count += $elems.find('h2').length;

          this.$moreButton.removeClass('loading').attr('disabled', false);

          if ( this.data.offset > 0 ) {
            this.$grid.masonry().append($elems).masonry('appended', $elems).masonry();

            this.$grid.masonry();

            $('body').trigger('esa-ajax-loaded');
          }

          if ( $elems.length < this.globals.posts_per_page || count === parseInt(response.data.count, 10) ) {
            this.$postsNav.slideUp(() => {
              this.$postsNav.remove();
            });
          }
        } else {
          this.$moreButton.toggleClass('loading');
          this.$postsNav.slideUp();
        }
      });
    });
  }
}

const postGrid = () => {
  const $containers = $('.layout-item.post_grid');

  $containers.each((index, container) => {
    new managePostGrid(container);
  });
};

export default postGrid;
