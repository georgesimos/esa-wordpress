class sectionBg {
  constructor() {
    $(window).on('mousemove', (e) => {
      this.dynamicBg(e);
    });
  }

  dynamicBg(e) {
    var percentageX = (e.clientX/window.innerWidth)*100;
    var percentageY = (e.clientY/window.innerHeight)*100;

    setTimeout(() => {
      $('.section-bg-wrapper .section-bg').css('transform', 'translate('+ percentageX/10 +'%, '+ percentageY/10 +'%)')
    }, 100);
  }
}

export default sectionBg;
