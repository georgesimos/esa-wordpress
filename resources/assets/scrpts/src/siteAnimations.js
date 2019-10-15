
/* eslint-disable */
import {TweenMax, Power0} from 'gsap';
import ScrollMagic from 'ScrollMagic';
import 'scrollmagic/scrollmagic/uncompressed/plugins/animation.gsap';
import 'scrollmagic/scrollmagic/uncompressed/plugins/debug.addIndicators';


class siteAnimations {
  constructor() {
    this.controller = new ScrollMagic.Controller();

    this.init = this.init.bind(this);
    this.reload = this.reload.bind(this);

    this.init();

    $(window).on('resize', () => {
      this.reload();
    });

    $('body').on('esa-ajax-loaded', () => {
      this.reload();
    });
  }

  init() {
    $('.elements-in').each((index, elem) => {
      const elementOffset = -$(window).height() * 0.1;

      new ScrollMagic.Scene({
        duration: 1,
        triggerElement: elem,
        offset: elementOffset,
      }).on('progress', function(event) {
        if (event.progress == 1) {
          $(elem).addClass('active');
        } else {
          if (!$(elem).hasClass('animate-once')) {
            $(elem).removeClass('active');
          }
        }
      }).addTo(this.controller);
    });


    $('.os-transform').each((index, elem) => {
      const targetPosY = $(elem).attr('data-transformY');
      const targetPosX = $(elem).attr('data-transformX');

      const tween = TweenMax.to(elem, 0.5, {
        y: targetPosY,
        ease: Power0.easeNone,
      });

      const tween2 = TweenMax.to(elem, 0.5, {
        x: targetPosX,
        ease: Power0.easeNone,
      });

      new ScrollMagic.Scene({
        duration: $(window).height() * 2,
        triggerElement: elem,
        triggerHook: 'onEnter',
      }).setTween(tween).addTo(this.controller);

      new ScrollMagic.Scene({
        duration: $(window).height() * 2,
        triggerElement: elem,
        triggerHook: 'onEnter',
      }).setTween(tween2).addTo(this.controller);
    });

    $('.os-opacity').each((index, elem) => {
      const targetOpacity = $(elem).attr('data-opacity');

      const tween = TweenMax.to(elem, 0.5, {
        opacity: targetOpacity,
        ease: Power0.easeNone,
      });

      new ScrollMagic.Scene({
        duration: $(window).height() * 2,
        triggerElement: elem,
        triggerHook: 'onEnter',
      }).setTween(tween).addTo(this.controller);
    });
  }

  reload() {
    this.controller.destroy(true);
    this.controller = new ScrollMagic.Controller();
    this.init();
  }
}

export default siteAnimations;
