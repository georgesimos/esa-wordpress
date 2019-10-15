// import external dependencies
import 'jquery';

// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import singleEsaStory from './routes/singleEsaStory';
import templateFullPage from './routes/templateFullPage';

/** Populate Router instance with DOM routes */
const routes = new Router({
  // All pages
  common,
  // Single Story
  singleEsaStory,
  // Template: Full Page
  templateFullPage,
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());
