class videoLayout {
  constructor() {
    this.$container = $('.layout-item.video-layout');

    this.$container.each((index, elem) => {
      $(elem).on('click', (e) => {
        e.preventDefault();

        this.play(elem);
      });
    });
  }

  play(elem) {
    const video = $(elem).find('video').get(0);

    if ($(elem).hasClass('playing')) {
      $(elem).removeClass('playing');
      video.pause();
    } else {
      $(elem).addClass('playing');
      video.play();
    }
  }
}

export default videoLayout;
