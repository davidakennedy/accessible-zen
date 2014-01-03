# Accessible Zen Documentation

Accessible Zen is an accessible, minimalistic, readable, and fully responsive WordPress theme by [David A. Kennedy](http://davidakennedy.com). Inspired by Leo Babauta's [Zen Habits theme](http://zenhabits.net/theme/), Accessible Zen puts the focus on your content and nothing else, plus it has plenty of WordPress goodness built right in.

## Header

Accessible Zen takes advantage of the Custom Header feature in WordPress. When you visit the `Appearance > Header` menu, you can upload your own image to help personalize your site. Here’s what you need to know:

1. The image will appear near the very top of your site. You can check out the official [Accessible Zen demo](http://wpthemes.davidakennedy.com/accessible-zen/) for a better look.
2. By default, Accessible Zen uses the [Gravatar](http://gravatar.com) of your WordPress site’s Administrator. If you don’t want to use that image, you can either change it on your [Gravatar](http://gravatar.com) profile or upload a new image via the `Appearance > Header` menu.
3. When you upload a new image or select an image from your Media Library for use as a Custom Header on your site, you’ll be asked to crop the image to the preferred image size. The preferred size is 150 pixels wide by 150 pixels tall. However, you can upload images with different dimensions because the theme supports Custom Headers with flexible widths and heights.

## Background

Accessible Zen supports the Custom Background feature in WordPress. When you visit the `Appearance > Background` menu, you can upload your own image or select a different color to help personalize your site. Here’s what you need to know:

1. The image or color will appear to the left and right of your main content. It goes away on web browsing devices with smaller screens and the site’s background becomes the default white again.
2. The main content area has a light shadow around the edges, so lighter background colors will look best.

## Widgets

Accessible Zen includes two Widget areas, both located just after your post/page content, but before the site credits. You can adjust Widgets by visiting the `Appearance > Widgets` menu. Here’s what you need to know:

1. When no Widgets are in place, nothing will show up. If you place one Widget in either Widget area, it will display as one column. If you place Widgets in both Widget areas, it will display as two columns.
2. Accessible Zen supports Internet 7 and above. However, on Internet 8 and below, use of the two Widget areas will only display as one column because these older browsers do not support Media Queries.

## Menus

Accessible Zen supports two Menus areas. When you visit the `Appearance > Menus` menu, you can adjust your menus and menu items to help personalize your site. Both menus appear toward the bottom of your site. Here’s what you need to know:

1. If no Menus are in place, nothing will show up.
2. If you put Menus in place, but do not add your own items via the `Appearance > Menus` menu, your Menus will show your site’s pages by default.
3. Both Menus only support one level of items. If you add sub-items to your Menus, those items will not appear on your site. 

## Page Templates

Accessible Zen comes with two custom page templates that help you customize your site. Here’s what you need to know:

1. **Front Page Template**: The Front Page Template allows you to go with a minimalist approach on your site’s front page. Selecting it will display **one** post from your site, excluding Sticky posts, on the page. You can also enter content on the page itself within the WordPress Admin, and that content will appear in a callout box above the one post. Check out the [Accessible Zen demo](http://wpthemes.davidakennedy.com/accessible-zen/) for an example.
2. **Archives Template**: The Archives Template allows your site’s users to navigate your blog posts in an a few easy ways. It shows a search box, post archives by month, category and tag. Check our the [Accessible Zen demo](http://wpthemes.davidakennedy.com/accessible-zen/page-template-archives/) for an example.

## Theme Customizer

Accessible Zen has tight integration with the WordPress Theme Customizer, allowing you to preview and save many of the changes you make on your site. Accessible Zen also adds two additional options that you can use to customize your site. Here’s what you need to know:

**Hide Site Tagline** (Under the Site Title & Tagline Setting): This checkbox allows you to hide your site's tagline if you wish. Checking the box will hide it, while leaving it unchecked will display it. It's displayed by default.

**Full Content or Excerpts** (Under the Content Setting): This option gives you greater control over how your content displays on certain pages of your site. Here’s what you need to know:

Full Content means that on your archive pages, like the blog page, the entire post content will be displayed. Select Full Content if you’d prefer this. It’s the default setting.

Excerpts means that on your archive pages, like the blog page, the except will be displayed. This is a manually set, handcrafted summary of your posts. You can read more about [excepts in WordPress on the Codex](http://codex.wordpress.org/Posts#Descriptions_of_Post_Fields). By default, your category archive, tag archive, author archive, day archive, month archive, year archive and search pages show excepts by default. This does not change by selecting either Full Content or Excerpts.

**Read More Link** (Under the Static Front Page Setting, when a static page is selected): The Read More Posts Link takes advantage of one of Accessible Zen’s page templates. It’s an option you only need to worry about if you’re using the Front Page Template. It allows you to add an additional link after your post on the Front Page Template. That link will say: “Read More Posts”

Here’s what you need to know:

* This option **only** shows up on the Front Page Template.
* If you are using the Front Page Template, but do not select a page to link to, nothing will show up.
* The link will say: “Read More Posts”.

## Extra Styles

Accessible Zen has some extra CSS styles built in that you can use to help customize your site. They are:

### Image Replacement

**Class name**: `ir`

**What it does**: Helps replace text with an image.

### Hidden

**Class name**: `hidden`

**What it does**: Hide from both screen readers and browsers.

### Screen Reader Text

**Class name**: `screen-reader-text`

**What it does**: Hide from browsers, but not screen readers.

### Invisible

**Class name**: `invisible`

**What it does**: Hide visually and from screenreaders, but maintain layout.

### No List

**Class name**: `nolist`

**What it does**: Create a unordered list or ordered list without bullets or numbers.

### Nav

**Class name**: `nav`

**What it does**: Create an horizontal list of navigation items, bested used on an unordered list.

### Callout

**Class name**: `callout`

**What it does**: Create a colored box around content to highlight it. Best used on paragraph or divs.

### CF

**Class name**: `cf`

**What it does**: Contain floats.

These are also [documented on the Demo site](http://wpthemes.davidakennedy.com/accessible-zen/theme-demo-extra-styles/).

Enjoy Accessible Zen!