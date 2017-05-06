# SemPress [![Build Status](https://travis-ci.org/dougbeal/SemPress.svg?branch=travis-ci)](https://travis-ci.org/dougbeal/SemPress)



[![Flattr this](http://button.flattr.com/flattr-badge-large.png)](https://flattr.com/submit/auto?user_id=pfefferle&url=https%3A%2F%2Fgithub.com%2Fpfefferle%2Fsempress)

A WordPress theme, highly semantic, HTML5 templates, responsive and SEO optimized.

![SenPress](https://raw.githubusercontent.com/pfefferle/SemPress/master/sempress/screenshot.png)

SemPress supports most of the new HTML5 tags, the new HTML5 input-types, microformats, microformats v2 and microdata (Schema.org).

## POSH - Plain old Semantic HTML

From the [micrormats wiki](http://microformats.org/wiki/posh):

> The term semantic-html is a mouthful, and belies both how simple it is, how well established
> it is among modern web designers, and the fact that it has benefits far beyond the obvious doing
> the right thing for the Web by using semantic markup. We need a simple short mnemonic term that
> captures the essence of the concept, and is easily verbed (to posh, poshify, poshed up).

SemPress is fully HTML5 compatible and uses a lot of the new tags, semantics and input-types.

## Web Semantics

SemPress' code is marked-up with microformats and microdata:

* used [microformats](http://microformats.org/):
    * [hAtom](http://microformats.org/wiki/hatom)
    * [hCard](http://microformats.org/wiki/hcard)
    * [rel-tag](http://microformats.org/wiki/rel-tag)
    * [XFN](http://microformats.org/wiki/xfn)
* used [microformats version 2](http://microformats.org/wiki/microformats-2):
    * [h-feed](http://microformats.org/wiki/h-feed)/[h-entry](http://microformats.org/wiki/h-entry)
    * [h-card](http://microformats.org/wiki/h-card)
    * [ActivityStreams](http://microformats.org/wiki/activity-streams) (h-as-bookmark, h-as-note, ...)
    * [Comment Draft](http://microformats.org/wiki/comment-brainstorming#microformats2_h-feed_p-comments)
* used [microdata](http://www.whatwg.org/specs/web-apps/current-work/multipage/microdata.html):
    * http://schema.org/Blog
    * http://schema.org/BlogPosting
    * http://schema.org/UserComments
    * http://schema.org/WebPage
    * http://schema.org/Person

Planned formats:

* micormats (v2): hAudio and hMedia
* microdata: http://schema.org/MediaObject

## WordPress Features

SemPress supports:

* [Custom Post Formats](http://codex.wordpress.org/Post_Formats): aside, status, gallery, video, audio, chat, quote, link and image
* [Post-Thumbnails](http://codex.wordpress.org/Post_Thumbnails)
* [Editor-Style](http://codex.wordpress.org/Function_Reference/add_editor_style)
* [Navigation Menus](http://codex.wordpress.org/Navigation_Menus)
* [Automatic Feed Links](http://codex.wordpress.org/Automatic_Feed_Links)
* [Custom-Header](http://codex.wordpress.org/Custom_Headers)
* [Custom-Backgrounds](http://codex.wordpress.org/Custom_Backgrounds)
* [Infinite Scroll](http://jetpack.me/support/infinite-scroll/) (JetPack)

## Translations

* **de_DE**
    * [Benjamin Hartwich](http://www.benjaminhartwich.de/) ([@benhartwich](https://twitter.com/benhartwich))
* **fr_FR**
    * [Julien Pierré](http://www.jp-software.fr/en/)
* **id_ID**
    * [Sugeng Tigefa](https://github.com/tigefa4u) ([@sugeng_tigefa](https://twitter.com/sugeng_tigefa))
    * [Rizky Luthfianto](https://github.com/rilut) ([@rilut](https://twitter.com/rilut))
* **ko_KR**
    * [CARLITO](http://www.calitosway.net) ([@calitoway](https://twitter.com/calitoway))
* **nb_NO**
    * [Kristoffer Risanger](https://github.com/kristofferR) ([@kristofferR](https://twitter.com/kristofferR))
* **ru_RU**
    * [Oleg](http://0leg.net) ([@oleg_sh](https://twitter.com/oleg_sh))
* **sv_SE**
    * [Christopher Anderton](http://deluxive.se/blog/) ([@deluxivese](https://twitter.com/deluxivese))

## Child themes

### [Index](http://cmx.org.uk/indextheme/) by [Phil Julian](http://cmx.org.uk/)

See <http://cmx.org.uk> for an example

### [SemPress Lite](https://github.com/jihaisse/SemPress-Lite) by [Jihaisse](http://jihais.se/)

![SemPress Lite](https://raw.githubusercontent.com/jihaisse/SemPress-Lite/master/sempress-lite/screenshot.png)

### [SenPress](https://github.com/pfefferle/SenPress) by me

![SenPress](https://raw.githubusercontent.com/pfefferle/SenPress/master/screenshot.png)

## Development
* npm install
* gem install sass
* grunt
