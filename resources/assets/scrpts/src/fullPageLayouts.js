import { Color } from 'three';
import 'fullpage.js/vendors/scrolloverflow';
import 'fullpage.js/dist/jquery.fullpage';
import Mountains from '../util/mountains';

class fullPageLayouts {
  constructor() {
    this.$layouts = $('.wrap');
    this.$scrollDown = $('.scroll-down-wrapper');
    this.$slideLink = $('.slide-link');
    this.mountains = null;

    this.preloadFullPage = this.preloadFullPage.bind(this);
    this.initFullPage = this.initFullPage.bind(this);
    this.change3d = this.change3d.bind(this);
    this.setColor = this.setColor.bind(this);

    this.preloadFullPage();
    this.initFullPage();

    this.$slideLink.on('click', (e) => {
      const goTo = $(e.currentTarget).attr('data-goto');

      if (goTo == 'front') {
        $.fn.fullpage.moveSlideRight();
      } else if (goTo == 'back') {
        $.fn.fullpage.moveSlideLeft();
      }
    });

    this.$scrollDown.on('click', function(){
      $.fn.fullpage.moveSectionDown();
    });
  }

  preloadFullPage() {
    const $targetSlide = $($('.hero-layout')[0]);
    const slideColor = $targetSlide.attr('data-bg-color');
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

    if ($targetSlide.attr('data-3d') && $targetSlide.attr('data-3d').length > 0) {
      terrainOptions = {...terrainOptions, ...JSON.parse($targetSlide.attr('data-3d'))};
    }

    this.mountains = new Mountains(terrainOptions);

    this.setColor(slideColor);
  }

  initFullPage() {
    this.$layouts.each((index, container) => {
      const that = this;
      const $container = $(container);
      const links = [];

      $('.hero-layout', container).each((i, c) => {
        links.push($(c).data('slidename'));
      });

      $container.fullpage({
        anchors: links,
        navigation: true,
        navigationPosition: 'left',
        navigationTooltips: links,
        scrollOverflow: true,
        slidesNavigation: true,
        sectionSelector: '.hero-layout',
        onLeave: function(index, nextIndex) {
          const targetSlide = $('.hero-layout').get(nextIndex - 1);

          $('body').addClass('animating');
          $('nav').removeClass('dark');
          $('#fp-nav').removeClass('hidden');

          $('.hero-layout').removeClass('currently-active');
          $(targetSlide).addClass('currently-active');

          if($(targetSlide).attr('data-bg-color') && $(targetSlide).attr('data-bg-color').length > 0) {
            const slideBgColor = $(targetSlide).attr('data-bg-color');

            setTimeout(() => {
              that.setColor(slideBgColor);
            }, 500);
          } else {
            setTimeout(() => {
              that.setColor('dark');
            }, 500);
          }

          if ($(targetSlide).attr('data-3d') && $(targetSlide).attr('data-3d').length > 0) {
            setTimeout(() => {
              that.change3d(JSON.parse($(targetSlide).attr('data-3d')));
            }, 500);
          }
        },
        afterLoad: function(anchorLink, index) {
          $('body').removeClass('animating');

          if (index == $('.hero-layout').length) {
            $('body').addClass('last-slide');
          } else {
            $('body').removeClass('last-slide');
          }
        },
        afterSlideLoad: function(anchorLink, index, slideAnchor, slideIndex) {
          const slideColor = $($('.hero-layout')[index - 1]).find('.slide')[slideIndex].getAttribute('data-bg-color');

          that.setColor(slideColor);
        },
        onSlideLeave: function(anchorLink, index, slideIndex, direction, nextSlideIndex) {
          var slideColor = $($('.hero-layout')[index - 1]).find('.slide')[nextSlideIndex].getAttribute('data-bg-color');

          that.setColor(slideColor);
        },
        afterRender: function() {
          const targetSection = $('.hero-layout.active');

          $.fn.fullpage.setAllowScrolling(false);
          targetSection.removeClass('currently-active');

          setTimeout(function() {
            targetSection.addClass('currently-active');
            $.fn.fullpage.setAllowScrolling(true);
          }, 500);
        },
        scrollingSpeed: 700,
        easingcss3: 'cubic-bezier(0.86, 0, 0.07, 1)',
      });
    });
  }

  change3d(data) {
    this.mountains.terrain.uniforms.speed.value = data.speed;
    this.mountains.terrain.uniforms.perlin_passes.value = data.perlin_passes;
    this.mountains.terrain.uniforms.elevation.value = data.elevation;
    this.mountains.terrain.uniforms.noise_range.value = data.noise_range;
    this.mountains.terrain.uniforms.sombrero_amplitude.value = data.sombrero_amplitude;
    this.mountains.terrain.uniforms.sombrero_frequency.value = data.sombrero_frequency;
    this.mountains.terrain.uniforms.line_color.value = new Color(data.wireframe_color);
  }

  setColor(slideBgColor) {
    if (slideBgColor == 'white') {
      $('nav').removeClass('white').addClass('dark');
      $('footer').removeClass('white').addClass('dark');
      $('#fp-nav').addClass('hidden');
      $('body').removeClass('page-style-dark').addClass('page-style-white');
    } else {
      $('nav').addClass('white').removeClass('dark');
      $('footer').addClass('white').removeClass('dark');
      $('#fp-nav').removeClass('hidden');
      $('body').removeClass('page-style-white').addClass('page-style-dark');
    }
  }
}

export default fullPageLayouts;
