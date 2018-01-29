<?php

if (!isset($content_width)) {
    $content_width = 600;
}

/**
 * Odin Classes.
 */
require_once get_template_directory() . '/core/classes/class-bootstrap-nav.php';
require_once get_template_directory() . '/core/classes/class-shortcodes.php';
require_once get_template_directory() . '/core/classes/class-thumbnail-resizer.php';
// require_once get_template_directory() . '/core/classes/class-theme-options.php';
// require_once get_template_directory() . '/core/classes/class-options-helper.php';
require_once get_template_directory() . '/core/classes/class-post-type.php';
require_once get_template_directory() . '/core/classes/class-taxonomy.php';
// require_once get_template_directory() . '/core/classes/class-metabox.php';
// require_once get_template_directory() . '/core/classes/abstracts/abstract-front-end-form.php';
// require_once get_template_directory() . '/core/classes/class-contact-form.php';
// require_once get_template_directory() . '/core/classes/class-post-form.php';
// require_once get_template_directory() . '/core/classes/class-user-meta.php';

/**
 * Odin Widgets.
 */
require_once get_template_directory() . '/core/classes/widgets/class-widget-like-box.php';

if (!function_exists('odin_setup_features')) {

    /**
     * Setup theme features.
     *
     * @since  2.2.0
     *
     * @return void
     */
    function odin_setup_features() {

        /**
         * Add support for multiple languages.
         */
        load_theme_textdomain('odin', get_template_directory() . '/languages');

        /**
         * Register nav menus.
         */
        register_nav_menus(
                array(
                    'main-menu' => 'Menu Principal'
                )
        );

        /*
         * Add post_thumbnails suport.
         */
        add_theme_support('post-thumbnails');

        /**
         * Add feed link.
         */
        add_theme_support('automatic-feed-links');

        /**
         * Support Custom Header.
         */
        $default = array(
            'width' => 0,
            'height' => 0,
            'flex-height' => false,
            'flex-width' => false,
            'header-text' => false,
            'default-image' => '',
            'uploads' => true,
        );

        add_theme_support('custom-header', $default);

        /**
         * Support Custom Background.
         */
        $defaults = array(
            'default-color' => '',
            'default-image' => '',
        );

        add_theme_support('custom-background', $defaults);

        /**
         * Support Custom Editor Style.
         */
        add_editor_style('assets/css/editor-style.css');

        /**
         * Add support for infinite scroll.
         */
        add_theme_support(
                'infinite-scroll', array(
            'type' => 'scroll',
            'footer_widgets' => false,
            'container' => 'content',
            'wrapper' => false,
            'render' => false,
            'posts_per_page' => get_option('posts_per_page')
                )
        );

        /**
         * Add support for Post Formats.
         */
        // add_theme_support( 'post-formats', array(
        //     'aside',
        //     'gallery',
        //     'link',
        //     'image',
        //     'quote',
        //     'status',
        //     'video',
        //     'audio',
        //     'chat'
        // ) );

        /**
         * Support The Excerpt on pages.
         */
        // add_post_type_support( 'page', 'excerpt' );
    }

}

add_action('after_setup_theme', 'odin_setup_features');

/**
 * Register widget areas.
 *
 * @since  2.2.0
 *
 * @return void
 */
function odin_widgets_init() {
    register_sidebar(
            array(
                'name' => __('Main Sidebar', 'odin'),
                'id' => 'main-sidebar',
                'description' => __('Site Main Sidebar', 'odin'),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h3 class="widgettitle widget-title">',
                'after_title' => '</h3>',
            )
    );
}

add_action('widgets_init', 'odin_widgets_init');

/**
 * Flush Rewrite Rules for new CPTs and Taxonomies.
 *
 * @since  2.2.0
 *
 * @return void
 */
function odin_flush_rewrite() {
    flush_rewrite_rules();
}

add_action('after_switch_theme', 'odin_flush_rewrite');

/**
 * Load site scripts.
 *
 * @since  2.2.0
 *
 * @return void
 */
function odin_enqueue_scripts() {
    $template_url = get_template_directory_uri();

    // Loads Odin main stylesheet.
    wp_enqueue_style('odin-style', get_stylesheet_uri(), array(), null, 'all');

    // jQuery.
    wp_enqueue_script('jquery');

    // Twitter Bootstrap.
    wp_enqueue_script('bootstrap', $template_url . '/assets/js/libs/bootstrap.min.js', array(), null, true);

    // General scripts.
    // FitVids.
    wp_enqueue_script('fitvids', $template_url . '/assets/js/libs/jquery.fitvids.js', array(), null, true);

    // Main jQuery.
    wp_enqueue_script('odin-main', $template_url . '/assets/js/main.js', array(), null, true);

    // Grunt main file with Bootstrap, FitVids and others libs.
    // wp_enqueue_script( 'odin-main-min', $template_url . '/assets/js/main.min.js', array(), null, true );
    // Load Thread comments WordPress script.
    if (is_singular() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'odin_enqueue_scripts', 1);

/**
 * Odin custom stylesheet URI.
 *
 * @since  2.2.0
 *
 * @param  string $uri Default URI.
 * @param  string $dir Stylesheet directory URI.
 *
 * @return string      New URI.
 */
function odin_stylesheet_uri($uri, $dir) {
    return $dir . '/assets/css/style.css';
}

add_filter('stylesheet_uri', 'odin_stylesheet_uri', 10, 2);


function admin_style(){
    //wp_enqueue_style('admin-style', get_template_directory_uri() . '/assets/css/editor.min.css');
    if (strpos($_SERVER ['REQUEST_URI'],'opcoes-do-tema') !== false)
        wp_enqueue_script( 'admin-functions', get_template_directory_uri() . '/core/assets/js/admin-functions.js', array( 'jquery' ), null, true );
}

add_action('admin_footer', 'admin_style');


/**
 * Core Helpers.
 */
require_once get_template_directory() . '/core/helpers.php';

/**
 * WP Custom Admin.
 */
require_once get_template_directory() . '/inc/admin.php';

/**
 * Comments loop.
 */
require_once get_template_directory() . '/inc/comments-loop.php';

/**
 * WP optimize functions.
 */
require_once get_template_directory() . '/inc/optimize.php';

/**
 * WP Custom Admin.
 */
require_once get_template_directory() . '/inc/plugins-support.php';

/**
 * Custom template tags.
 */
require_once get_template_directory() . '/inc/template-tags.php';

require_once get_template_directory() . '/core/classes/class-theme-options.php';


$odin_theme_options = new Odin_Theme_Options(
        'opcoes-do-tema', // Slug/ID da página (Obrigatório)
        __('Opções do tema', 'odin'), // Titulo da página (Obrigatório)
        'manage_options' // Nível de permissão (Opcional) [padrão é manage_options]
);

$odin_theme_options->set_tabs(
        array(
            array(
                'id' => 'geral', // ID da aba e nome da entrada no banco de dados.
                'title' => __('Configurações', 'odin'), // Título da aba.
            ),
        )
);

$odin_theme_options->set_fields(
        array(
            'general_section' => array(
                'tab' => 'geral', // Sessão da aba odin_general
                'title' => __('Cabeçalho', 'odin'),
                'fields' => array(
                    array(
                        'id' => 'logo', // Obrigatório
                        'label' => 'Logo',
                        'type' => 'image', // Obrigatório
                        'description' => 'Faça o Upload da sua logo aqui'
                    ),
                    array(
                        'id' => 'ico', // Obrigatório
                        'label' => 'FavIcon',
                        'type' => 'image', // Obrigatório
                        'description' => 'Faça o Upload de seu favico aqui'
                    ),
                    array(
                        'id' => 'cor_menu', // Obrigatório
                        'label' => 'Cor do Menu - Hover',
                        'type' => 'color', // Obrigatório
                        // 'attributes' => array(), // Opcional (atributos para input HTML/HTML5)
                        'default' => '#1e73be', // Opcional (cor em hexadecimal)
                        'description' => 'Coloque aqui a cor do menu quando focado'
                    ),
                    array(
                        'id' => 'posicao_sidebar', // Obrigatório
                        'label' => 'Posição da Sidebar',
                        'type' => 'select', // Obrigatório
                        'options' => array(// Obrigatório (adicione aque os ids e títulos)
                            '0' => 'Esquerda',
                            '1' => 'Direita',
                        ),
                    ),
                )
            ),
            
        )
);


add_image_size('thumb-artigo', 335, 230, true);

function criar_formulario_captura($optin, $botao, $placeholder) {
    if ($optin == '')
        return '';
    $optin = extrair_campos($optin, $placeholder);
    $target = ( strtolower(setar_variavel($optin['target'])) == '_blank' ) ? ' target="_blank"' : '';
    $cont = 0;
    $html = '';
    $html .= '<form method="post" class="form form-inline opl-resp-submit" action="' . setar_variavel($optin['action']) . '"' . $target . '>' . "\n";
    if (isset($optin['fields']) && is_array($optin['fields']) && count($optin['fields']) > 0) {
        foreach ($optin['fields'] as $k => $v) {
            //$field_id = ( stristr( $k, 'mail') || stristr( $k, 'from') ) ? 'opl_email' : 'opl_name';

            if (stristr($k, 'mail') || stristr($k, 'from')) {
                $field_class = 'email';
                $field_type = 'email';
                $html .= '<div class="form-group ' . $field_class . '"><input type="' . $field_type . '" name="' . $k . '" value="" id="" class="form-control ' . $field_class . '" required="required" placeholder="' . stripslashes($v) . '" /></div>' . "\n";
            } else {
                if (isset($exibir_campos))
                    if ($exibir_campos == 1) {
                        $field_class = 'text';
                        $field_type = 'text';
                        $html .= '<div class="text-box ' . $field_class . '"><input type="' . $field_type . '" name="' . $k . '" value="" id="" class="' . $field_class . '" placeholder="' . stripslashes($rotulos[$cont]) . '" /></div>' . "\n";
                        $cont++;
                    }
            }
        }
    }

    if (isset($optin['hiddens']) && is_array($optin['hiddens']) && count($optin['hiddens']) > 0) {
        foreach ($optin['hiddens'] as $k => $v) {
            $html .= '<input type="hidden" name="' . $k . '" value="' . $v . '" />' . "\n";
        }
    }

    $html .= '<button id="submit-captura" type="submit" class="btn readmore">
                    <span class="text">' . $botao . '</span>
		</button>';

    $html .= '</form>';

    return $html;
}

function setar_variavel(&$val, $default = null) {
    if (isset($val))
        $tmp = $val;
    else
        $tmp = $default;
    return $tmp;
}

function extrair_atributo($field, $attrib) {
    $value = '';
    /*
      $remove    = array($attrib . '=', '"', "'", "/>");
      $field     = str_replace("'", "\"", $field);
      $pos       = strpos($field, $attrib . "=");
      $filter    = substr_replace($field, "", 0, $pos);
      $pos2      = strpos($filter, " ");
      $pos2      = ( $pos2 != '' ) ? $pos2 : strpos($filter, ">");
      $attribute = substr_replace($filter, "", $pos2, 1000);
      $attribute = str_replace( $remove, '', $attribute );
     */

    $pattern = ( $attrib == 'name' ) ? '/<input\s[^>]*name=[\'"]([^\'"]+)[\'"]/i' : '/<input\s[^>]*value=[\'"]([^\'"]+)[\'"]/i';

    preg_match($pattern, stripslashes($field), $matches);

    $value = (!isset($matches[1]) ) ? '' : $matches[1];
    return $value;
}

function extrair_campos($code, $email_label) {
    if ($code == '')
        return false;

    $code = html_entity_decode(stripslashes($code));
    if (!preg_match('/<form\s[^>]*action=[\'"]([^\'"]+)[\'"]/i', $code, $form)) {
        if (stristr($code, 'iframe') && function_exists('file_get_contents')) {
            preg_match('/<iframe\s[^>]*src=[\'"]([^\'"]+)[\'"]/i', $code, $matches);
            if (isset($matches[1])) {
                $iframe_url = html_entity_decode(urldecode($matches[1]));
                $content = @file_get_contents($iframe_url);

                if (!empty($content))
                    $code = $content;
            }
        }

        if (stristr($code, '<script') && function_exists('file_get_contents')) {
            preg_match('/<script\s[^>]*src=[\'"]([^\'"]+)[\'"]/i', $code, $matches);
            if (isset($matches[1])) {
                $js_url = html_entity_decode(urldecode($matches[1]));
                $content = @file_get_contents($js_url);
                if (!empty($content) && stristr($content, 'document.write')) {
                    $code = stripslashes($content);
                }
            }
        }
    }

    // GR filter
    preg_match_all('/<li\s[^>]*style=([\"\']??)([^\" >]*?)\\1[^>]*>(.*)<\/li>/siU', $code, $gr);
    if (is_array($gr[0]) && count($gr[0]) > 0) {
        foreach ($gr[0] as $c) {
            if (stristr($c, 'wf-name') && stristr($c, 'none')) {
                $code = str_replace($c, '', $code);
            }
        }
    }

    preg_match('/<form\s[^>]*action=[\'"]([^\'"]+)[\'"]/i', $code, $form);
    preg_match('/<form\s[^>]*target=[\'"]([^\'"]+)[\'"]/i', $code, $target);
    preg_match_all('/<input\s[^>]*type=[\'"]?hidden[^>]*>/i', $code, $hiddens);
    preg_match_all('/<input\s[^>]*type=([\'"])?(text|email)[^>]*>/i', $code, $texts);


    // Text fields
    $fields = '';
    if (!empty($texts[0])) {
        foreach ($texts[0] as $text) {
            preg_match_all('/<input\s[^>]*style=[\'"]([^\'"]+)[\'"]/i', $text, $styles);
            if (isset($styles[1][0])) {
                if (stristr($styles[1][0], 'display:none'))
                    continue;
                if (stristr($styles[1][0], 'display: none'))
                    continue;
            }

            if (strpos($text, 'tabindex="-1"') > 0)
                continue;
            $name = extrair_atributo($text, 'name');
            //var_dump($name);
            if (!is_array($fields))
                $fields = array();
            $name_label = '';
            $fields[$name] = ( stristr($name, 'mail') || stristr($name, 'from') ) ? $email_label : $name_label;
        }
    }

    // Hidden fields
    $values = '';
    if (!empty($hiddens[0])) {
        foreach ($hiddens[0] as $hidden) {
            $name = extrair_atributo($hidden, 'name');
            $value = extrair_atributo($hidden, 'value');

            if (!is_array($values))
                $values = array();

            $values[$name] = $value;
        }
    }

    // Additional hidden fields
    if (!empty($texts[0])) {
        foreach ($texts[0] as $text) {
            preg_match_all('/<input\s[^>]*style=[\'"]([^\'"]+)[\'"]/i', $text, $styles);
            if (isset($styles[1][0])) {
                if (stristr($styles[1][0], 'display:none') || stristr($styles[1][0], 'display: none')) {
                    $name = $this->extrair_atributo($text, 'name');
                    $value = $this->extrair_atributo($text, 'value');

                    if (!is_array($values))
                        $values = array();

                    $values[$name] = $value;
                }
            }
        }
    }

    $post_data['action'] = setar_variavel($form[1]);
    $post_data['target'] = setar_variavel($target[1]);
    $post_data['fields'] = $fields;
    $post_data['hiddens'] = $values;

    return $post_data;
}

function excerpt($limit) {
    $excerpt = explode(' ', get_the_content(''), $limit);
    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . '...</p>';
    } else {
        $excerpt = implode(" ", $excerpt);
    }
    $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
    return $excerpt;
}
