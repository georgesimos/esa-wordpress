class sideNav {
  constructor() {
    this.menuOpen = false;
    this.lastScroll = $(window).scrollTop();
    this.navMargin = 0;
    this.maxScroll = $(document).height() + $(window).height();
    this.$nav = $('nav');
    this.$navTrigger = $('.menu-trigger', this.$nav);
    this.$navTriggerFooter = $('footer .menu-trigger');
    this.$navWrapper = $('.menu-wrapper');
    this.$navLinksWrapper = $('.menu-links-wrapper');

    this.adjustNav = this.adjustNav.bind(this);
    this.openNav = this.openNav.bind(this);
    this.closeNav = this.closeNav.bind(this);
    this.disableScroll = this.disableScroll.bind(this);
    this.enableScroll = this.enableScroll.bind(this);

    this.adjustNav();

    $(window).on('scroll', () => {
      if (!this.menuOpen) {
        this.adjustNav();
      }
    });

    this.$navTrigger.on('click', () => {
      if (this.menuOpen) {
        this.closeNav()
      } else {
        this.openNav();
      }
    });

    this.$navTriggerFooter.on('click', () => {
      this.$navTrigger.addClass('active');
      this.openNav();
    });

    $('a', this.$navWrapper).on('click', () => {
      this.closeNav();
    });

    $(window).on('keydown', (e) => {
      if (e.keyCode == 27) {
        this.closeNav();
      }
    });

    $('.menu-wrapper li.has-submenu .menu-link').on('click', (e) => {
      this.$navLinksWrapper.toggleClass('submenu-open');

      if ($(e.currentTarget).closest('li').hasClass('submenu-open')) {
        $(e.currentTarget).closest('li').removeClass('submenu-open');
        this.$nav.removeClass('subnav-open');
      } else {
        $(e.currentTarget).closest('li').addClass('submenu-open');
        this.$nav.addClass('subnav-open');
      }
    });
  }

  adjustNav() {
    const navHeight = this.$nav.outerHeight();
    let currentScroll = $(window).scrollTop();
    let scrollDiff;

    if (currentScroll < $('nav').outerHeight()) {
      currentScroll = 0;
    } else if (currentScroll > this.maxScroll) {
      currentScroll = this.maxScroll;
    }

    scrollDiff = currentScroll - this.lastScroll;

    this.navMargin += scrollDiff;

    if (this.navMargin < 0) {
      this.navMargin = 0;
    } else if (this.navMargin > navHeight) {
      this.navMargin = navHeight;
    }

    this.$nav.css('margin-top', -this.navMargin);

    this.lastScroll = currentScroll;

    //change bg colour

    if (currentScroll > 0) {
      this.$nav.addClass('scrolled');
    } else {
      this.$nav.removeClass('scrolled');
    }
  }

  openNav() {
    this.$navTrigger.addClass('active');
    this.$navWrapper.addClass('active');
    this.$nav.addClass('open');
    this.menuOpen = true;
    this.navMargin = 0;
    this.adjustNav();
    this.disableScroll();
  }

  closeNav() {
    this.$navTrigger.removeClass('active');
    this.$navWrapper.removeClass('active');
    this.$nav.removeClass('open');
    this.$navLinksWrapper.removeClass('submenu-open');
    $('li.has-submenu', this.$navWrapper).removeClass('submenu-open');
    this.menuOpen = false;
    this.enableScroll();
    this.$nav.removeClass('subnav-open');
  }

  disableScroll() {
    if (window.addEventListener) // older FF
      window.addEventListener('DOMMouseScroll', this.preventDefault, false);

    window.onwheel = this.preventDefault; // modern standard
    window.onmousewheel = document.onmousewheel = this.preventDefault; // older browsers, IE
    window.ontouchmove = this.preventDefault; // mobile
    document.onkeydown = this.preventDefaultForScrollKeys;

    if (typeof $.fn.fullpage.setAllowScrolling !== 'undefined') {
      $.fn.fullpage.setAllowScrolling(false);
    }
  }

  enableScroll() {
    if (window.removeEventListener)
      window.removeEventListener('DOMMouseScroll', this.preventDefault, false);

    window.onmousewheel = document.onmousewheel = null;
    window.onwheel = null;
    window.ontouchmove = null;
    document.onkeydown = null;

    if (typeof $.fn.fullpage.setAllowScrolling !== 'undefined') {
      $.fn.fullpage.setAllowScrolling(true);
    }
  }

  preventDefault(e) {
    e = e || window.event;
    if (e.preventDefault)
      e.preventDefault();
    e.returnValue = false;
  }

  preventDefaultForScrollKeys(e) {
    const keys = { 37: 1, 38: 1, 39: 1, 40: 1, 32: 1 };

    if (keys[e.keyCode]) {
      this.preventDefault(e);
      return false;
    }
  }
}

export default sideNav;
