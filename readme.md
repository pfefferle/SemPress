SemPress
============

A semantic html5 WordPress Theme with a little SEO

POSH - Plain old Semantic HTML
--------------

From the [micrormats wiki](http://microformats.org/wiki/posh):

> The term semantic-html is a mouthful, and belies both how simple it is, how well established
> it is among modern web designers, and the fact that it has benefits far beyond the obvious doing
> the right thing for the Web by using semantic markup. We need a simple short mnemonic term that
> captures the essence of the concept, and is easily verbed (to posh, poshify, poshed up).

SemPress is fully HTML5 compatible and uses a lot of the new tags for the best possible content structure:

```php
<aside <?php post_id(); ?> <?php post_class(); ?>>
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

* used microformats: hAtom, hCard, rel-tag and XFN
* used microformats version 2: h-atom and h-card
* used microdata: schema.org/Blog, schema.org/BlogPosting and schema.org/person

Planned formats:

* micormats (v2): hAudio and hMedia
* microdata: schema.org/MediaObject