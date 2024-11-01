<?php

namespace SimpleDataTables;

defined('ABSPATH') || exit;
?>
<div class="wrap">
  <div id="poststuff">
    <div id="post-body">
      <div id="post-body-content">
        <div class="wrap-card-container simple-data-tables">
          <div class="wrap card">
            <h1><?php echo NAME; ?></h1>
            <p class="lead">
              Quickly and easily create and embed interactive data tables with your posts, pages, comments, users, or attachments.
            </p>
            <p>
              With only a few clicks export and display your <strong>post, page, comment, media or user</strong> data as an interactive front-end tables.
            </p>
            <p>
              Easily extend and style you output to match your site layout, color scheme and design.
            </p>
          </div>
          <div class="wrap card">
            <h3>Usage</h3>
            <p>
              Create and add the <code>[simple-data-table]</code> shortcode on the fly inside the Gutenberg block editor.
            </p>
            <ol>
              <li>The <strong>Simple Data Table</strong> shortcode can be found under the Widgets tab, or you can just search for <code>dynamic table</code> under the Content Blocks after you install and activate the plugin.</li>
            </ol>
            <p>
              You can add Simple Data Tables as a standalone <code>shortcode</code> content block inside your Gutenberg block editor.
            </p>
            <p>
              Additionally you can load it up with the <code>do-shortcode</code> function.
            </p>
            <pre><mark>&lt;?php echo do_shortcode('[simple-data-table]'); ?&gt;</mark></pre>
            <p>
              Below is the full shortcode structure with all the available attributes and their accepted arguments.
            </p>
            <pre><mark>[simple-data-table 
type="post|page|attachment|comment|user" 
filter="author" 
display="id,author,date,title,status,link" 
return="html"]</mark></pre>
          </div>
          <div class="wrap card">
            <h3>Gutenberg Ready</h3>
            <p>
              Gutenberg intergrated shortcode, with only few click you can have your table created and ready to be published on any post or page.
            </p>
            <ol>
              <li>
                <strong>Easily add and configure the <?php echo NAME; ?> to any page or post using the <code>[simple-data-table]</code> shortcode.</strong>
                <br /><br />
                <a href="<?php echo URL; ?>/assets/img/screenshot-1.png" target="_blank">
                  <img src="<?php echo URL; ?>/assets/img/screenshot-1.png" alt="" class="sdt-img-fluid" />
                </a>
                <br /><br />
                <a href="<?php echo URL; ?>/assets/img/screenshot-2.png" target="_blank">
                  <img src="<?php echo URL; ?>/assets/img/screenshot-2.png" alt="" class="sdt-img-fluid" />
                </a>
              </li>
            </ol>
            <h3><?php echo NAME; ?> Front-end View</h3>
            <p>
              The front-end HTML table is easily extendable and customizable, no additional overhead.
            </p>
            <ol>
              <li>
                <strong>Example front-end interactive, searchable, and sortable table displaying all posts with different WordPress themes.</strong>
                <br /><br />
                <a href="<?php echo URL; ?>/assets/img/screenshot-3.png" target="_blank">
                  <img src="<?php echo URL; ?>/assets/img/screenshot-3.png" alt="" class="sdt-img-fluid" />
                </a>
                <br /><br />
                <a href="<?php echo URL; ?>/assets/img/screenshot-4.png" target="_blank">
                  <img src="<?php echo URL; ?>/assets/img/screenshot-4.png" alt="" class="sdt-img-fluid" />
                </a>
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>