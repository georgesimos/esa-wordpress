import bannerBg from '../src/bannerBg';
import postGrid from '../src/postGrid';
import sectionBg from '../src/sectionBg';
import sideNav from '../src/sideNav';
import siteAnimations from '../src/siteAnimations';
import videoLayout from '../src/videoLayout';

export default {
  init() {
    new bannerBg();
    new postGrid();
    new sectionBg();
    new sideNav();
    new siteAnimations();
    new videoLayout();

    $(window).on('load', () => {
      $('body').addClass('loaded');
    });
  },
};
