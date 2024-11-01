<?php
/*
  Plugin Name:  Simple Data Tables
  Plugin URI:   https://developry.com/simple-data-tables
  Description:  Quickly and easily create and embed interactive data tables with your posts, pages, comments, users, or attachments.
  Version:      1.1.1
  Author:       Developry
  Author URI:   https://developry.com/
  License:      GNU General Public License, version 2
  License URI:  https://www.gnu.org/licenses/gpl-2.0.html
  Text Domain:  simple-data-tables

  Copyright 2018 - 2021 Developry (email: hello@developry.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

namespace SimpleDataTables;

defined('ABSPATH') || exit;

define('SimpleDataTables\UUID', 'sdt');
define('SimpleDataTables\NAME', 'Simple Data Tables');
define('SimpleDataTables\DOC_PAGE', 'https://developry.com/simple-data-tables');
define('SimpleDataTables\SLUG', 'simple-data-tables');
define('SimpleDataTables\TEXT_DOMAIN', 'simple-data-tables');
define('SimpleDataTables\VERSION', '1.1.1');
define('SimpleDataTables\MIN_PHP_VERSION', '7.2');
define('SimpleDataTables\MIN_WP_VERSION', '5.0');
define('SimpleDataTables\FILE',  __FILE__);
define('SimpleDataTables\DIR_PATH', plugin_dir_path(__FILE__));
define('SimpleDataTables\BASENAME', plugin_basename(__FILE__));
define('SimpleDataTables\URL',  plugins_url('/', __FILE__));

require_once DIR_PATH . 'inc/config.php';
require_once DIR_PATH . 'inc/settings.php';
require_once DIR_PATH . 'inc/shortcode.php';
