
<div class="section-bg-wrapper page-bg white">
    <div class="section-bg"></div>
  </div>

<article @php post_class() @endphp>
<header class="layout-item hero_title is_post">
    <div class="row">
      <span class="background-text os-transform" data-transformX="-20%">
        Earth Science Analytics
      </span>
      <h1>  {!! get_the_title() !!}</h1>
    </div>
  </header>
  <section class="row post-content">
     @php the_content() @endphp
  </section>   

    @php comments_template('/partials/comments.blade.php') @endphp
  </article> 

  