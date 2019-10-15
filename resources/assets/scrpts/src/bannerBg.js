import Mountains from '../util/mountains';

class bannerBg {
  constructor() {
    this.mountains = null;
    this.$container = $('.layout-item.banner-layout.has-threed');

    this.init = this.init.bind(this);

    this.$container.each((index, elem) => {
      this.init($(elem));
    });
  }

  init($target) {
    let terrainOptions = {
      elevation: -0.2,
      noise_range: -1.3,
      sombrero_amplitude: 1,
      sombrero_frequency: 2,
      speed: 0.42,
      segments: 250,
      wireframe_color: '#068ed9',
      perlin_passes: 2,
      wireframe: true,
      floor_visible: false,
    };

    if ($target.attr('data-3d') && $target.attr('data-3d').length > 0) {
      terrainOptions = {...terrainOptions, ...JSON.parse($target.attr('data-3d'))};
    }

    this.mountains = new Mountains(terrainOptions);
  }
}

export default bannerBg;
