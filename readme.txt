=== Simple Data Tables ===

Contributors: developry
Donate Link: https://developry.com/donate
Tags: block, gutenberg, shortcode, table
Requires at least: 5.0
Tested up to: 5.7
Requires PHP: 7.2
Stable tag: 1.1.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Quickly and easily create and embed interactive data tables with your posts, pages, comments, users, or attachments.

## Description

Create interactive, sortable, and searchable content tables using the `[simple-data-table]` shortcode content block.

With only a few clicks export and display your post, page, comment, media or users data as an interactive front-end tables.

Easily extend and style you output table to match your site layout, color scheme and design.

### Usage

- Create and add the `[simple-data-table]` shortcode on the fly wihtin Gutenberg.

The shortcode can be found under the **Widgets** tab, or you can just search for **simple data table** and it will show up.

- Add as a standalone shortcode tag or use the `do_shortcode` function to load up.

You can add the content block as a standalone **shortcode** within Gutenberg.

- Additionally you can load it up with the `do-shortcode` function.

<?php echo do_shortcode( '[simple-data-table]' ); ?>

- Below is the full shortcode structure with all the available attributes and their accepted values.

  [simple-data-table
  type="post|page|attachment|comment|user"
  filter="author"
  display="id,author,date,title,status,link"
  return="html"
  ]

You can just run `[simple-data-table]` to give it a try and preview the output.

**Note:** You can change the order of your table columns inside the **display** attribute by rearranging the accepted column values.

### Features

- Embed content in several different ways: with shortcode, programmatically with `do_shorcode` or within the Gutenberg editor as block.
- Use apply `alignwide` or `alignfull` classes to your tables (if you theme supports them).
- Turn off default styles and apply your own with the prodived CSS/SCSS template skeleton.

### Detailed Documentaion

Additional information with step-by-step setup, usage, demos, video, and insights can be found on [**Simple Data Tables**](https://developry.com/simple-data-tables).

### Simple Data Tables Pro

As of yet this plugin doesn't have a commercial version available.

## Frequently Asked Questions

As of right now, none.

Use the [Support](https://wordpress.org/support/plugin/superscripted/) tab on this page to post your requests and questions.

All tickets are usually addressed within several days.

If your request is an add-on feature related we will add it to the plugin wish list and consider implementing it in the next major version.

## Screenshots

1. screenshot-1.(png)
2. screenshot-2.(png)
3. screenshot-3.(png)
4. screenshot-4.(png)

## Installation

The plugin installation process is standard and easy to follow, please let us know if you have any difficulties difficulties with the installation.

= Installation from WordPress =

1. Visit **Plugins > Add New**.
2. Search for **Simple Data Tables**.
3. Install and activate the **Simple Data Tables** plugin.
4. You will be either redirected to the plugin main page or need click on the plugin settings link.

= Manual Installation =

1. Upload the entire `superscripted` folder to the `/wp-content/plugins/` directory.
2. Visit **Plugins**.
3. Activate the **Simple Data Tables** plugin.
4. You will be either redirected to the plugin main page or need click on the plugin settings link.

= After Activation =

1. Click on the **Setting** link or go to **Tools > Simple Data Tables** for more information.

## Changelog

= 1.1 =

- Total revision of the plugin with improved code and UI.

= 1.0 =

- Initial release and first commit into the WordPress.org SVN.

## Upgrade Notice

_None_
