SemPress
============

A highly semantic, HTML5 template, responsive and seo optimized. SemPress supports most of the new HTML5 tags, the new HTML5 input-types, microformats, microformats v2 and microdata (Schema.org).

POSH - Plain old Semantic HTML
--------------

From the [micrormats wiki](http://microformats.org/wiki/posh):

> The term semantic-html is a mouthful, and belies both how simple it is, how well established
> it is among modern web designers, and the fact that it has benefits far beyond the obvious doing
> the right thing for the Web by using semantic markup. We need a simple short mnemonic term that
> captures the essence of the concept, and is easily verbed (to posh, poshify, poshed up).

SemPress is fully HTML5 compatible and uses a lot of the new tags for the best possible content structure:

```php
<aside <?php sempress_post_id(); ?> <?php post_class(); ?>>
  <header class="entry-header">
    <h1 class="entry-title p-entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'sempress' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
  </header><!-- .entry-header -->

  ...
  
  <footer class="entry-meta">
    <?php sempress_posted_on(); ?>
    ...
  </footer><!-- #entry-meta -->
</aside><!-- #post-<?php the_ID(); ?> -->
```

SemPress also uses HTML5s new input types and the required-attribute for a better client-side form handling:

```html
<input id="email" name="email" type="email" required value="" size="30" aria-required="true">
```

Web Semantics
--------------

SemPress' code is marked-up with microformats and microdata:

* used [microformats](http://microformats.org/): [hAtom](http://microformats.org/wiki/hatom), [hCard](http://microformats.org/wiki/hcard), [rel-tag](http://microformats.org/wiki/rel-tag) and [XFN](http://microformats.org/wiki/xfn)
* used [microformats version 2](http://microformats.org/wiki/microformats-2): h-atom and h-card
* used [microdata](http://www.whatwg.org/specs/web-apps/current-work/multipage/microdata.html): http://schema.org/Blog, http://schema.org/BlogPosting, http://schema.org/WebPage and http://schema.org/Person

Planned formats:

* micormats (v2): hAudio and hMedia
* microdata: http://schema.org/MediaObject

WordPress Features
--------------

SemPress supports:

* [Custom Post Types](http://codex.wordpress.org/Post_Types): aside, status, gallery, video, audio, link and image
* [Post-Thumbnails](http://codex.wordpress.org/Post_Thumbnails)
* [Editor-Style](http://codex.wordpress.org/Function_Reference/add_editor_style)
* [Navigation Menus](http://codex.wordpress.org/Navigation_Menus)
* [Automatic Feed Links](http://codex.wordpress.org/Automatic_Feed_Links)

Planned features:

* custom header

[![endorse](http://api.coderwall.com/pfefferle/endorsecount.png)](http://coderwall.com/pfefferle)