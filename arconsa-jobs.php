<?php
/*
Plugin Name: Arconsa Jobs
Plugin URI: https://smkonline.co/
Description: Aplicativo para gestionar vacantes de empleo
Author: SMk Online
Author URI: https://smkonline.co/
Text Domain: arconsa-jobs
Version: 1.0.0
*/

// <-------------------- Custom functions -----------------------> 


/**
 * Add Bootstrap CSS
 */
function ajp_add_bootstrap()
{
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', array(), '', true);
}
add_action('wp_enqueue_scripts', 'ajp_add_bootstrap');


/**
 * Register Theme Scripts
 * https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts/
 */
function ajp_scripts()
{
    wp_enqueue_style('ajp-styles', plugin_dir_url(__FILE__) . '/css/ajp_style.css');
}
add_action('wp_enqueue_scripts', 'ajp_scripts');


/**
 * Install latest jQuery version 3.5.1
 */
if (!is_admin()) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"), false);
    wp_enqueue_script('jquery');
}


/**
 * Add ACF options page
 */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'    => 'Theme Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-settings',
        'capability'    => 'edit_posts',
        'redirect'      =>  true
    ));

    acf_add_options_sub_page(array(
        'page_title'     => 'Formulario de solicitudes',
        'menu_title'     => 'Formulario',
        'parent_slug'   => 'theme-settings',
    ));
}


/**
 * Create customs fields
 */
if (function_exists('acf_add_local_field_group')) :

    acf_add_local_field_group(array(
        'key' => 'group_61e1fc081dda4',
        'title' => 'Especificaciones de la vacante',
        'fields' => array(
            array(
                'key' => 'field_61e1fc2542818',
                'label' => 'Perfil del cargo',
                'name' => 'job_description',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
                'delay' => 0,
            ),
            array(
                'key' => 'field_61e1fc7a4281a',
                'label' => 'Fecha de cierre de convocatoria',
                'name' => 'job_closing_date',
                'type' => 'date_picker',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
                'first_day' => 1,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'jobs',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));

    acf_add_local_field_group(array(
        'key' => 'group_623ba1f2920c1',
        'title' => 'Formulario de solicitudes',
        'fields' => array(
            array(
                'key' => 'field_623ba204905d7',
                'label' => 'Shortcode',
                'name' => 'shortcode_form',
                'type' => 'text',
                'instructions' => 'Aquí se deberá copiar el shortcode del formulario de solicitudes, que se visualizará al momento de que un usuario aplique a una vacante disponible.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-formulario',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => array(
            0 => 'the_content',
        ),
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
        'modified' => 1648133804,
    ));

    acf_add_local_field_group(array(
        'key' => 'group_61e2115ccd906',
        'title' => 'Página de Vacantes',
        'fields' => array(
            array(
                'key' => 'field_61e2117c8d7a9',
                'label' => 'Título',
                'name' => 'title',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_61e21187f9f72',
                'label' => 'Descripción',
                'name' => 'description',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
                'delay' => 0,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'templates/vacancies-template.php',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => array(
            0 => 'the_content',
        ),
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));
endif;


/**
 * Post Type: Vacantes.
 */
function cptui_register_my_cpts_jobs()
{
    $labels = [
        "name" => __("Vacantes", "custom-post-type-ui"),
        "singular_name" => __("vacante", "custom-post-type-ui"),
    ];

    $args = [
        "label" => __("Vacantes", "custom-post-type-ui"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => ["slug" => "jobs", "with_front" => true],
        "query_var" => true,
        "menu_icon" => "dashicons-portfolio",
        "supports" => ["title", "custom-fields"],
        "show_in_graphql" => false,
    ];

    register_post_type("jobs", $args);
}
add_action('init', 'cptui_register_my_cpts_jobs');


/**
 * Post Type: Hojas de Vida.
 */
function cptui_register_my_cpts_resumes()
{

    $labels = [
        "name" => __("Hojas de Vida", "custom-post-type-ui"),
        "singular_name" => __("hoja de vida", "custom-post-type-ui"),
    ];

    $args = [
        "label" => __("Hojas de Vida", "custom-post-type-ui"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => false,
        "show_ui" => true,
        'show_in_menu' => 'edit.php?post_type=jobs',
        "show_in_nav_menus" => false,
        "exclude_from_search" => false,
        'capabilities' => array(
            'create_posts' => false
        ),
        "map_meta_cap" => true,
        "hierarchical" => false,
        "menu_icon" => "dashicons-portfolio",
        'supports' => array('custom-fields')
    ];

    register_post_type("resumes", $args);
}
add_action('init', 'cptui_register_my_cpts_resumes');


/**
 * Add "Solicitudes para la vacante" custom column Jobs Posts.
 */
function ajp_view_application_column($columns)
{
    $column = array_merge(
        $columns,
        array(
            'view_applicants' => esc_html__('Solicitudes para la vacante', 'custom-post-type-ui'),
        )
    );

    return $column;
}
add_filter('manage_jobs_posts_columns', 'ajp_view_application_column');


/**
 * Add value to "Solicitudes para la vacante" Column
 */
function ajp_view_application_column_value($column, $post_id)
{
    // Add "Solicitudes para la vacante Link"
    if ('view_applicants' == $column) {
        $jobpost = get_children(array('posts_per_page' => -1, 'post_parent' => $post_id, 'post_type' => 'resumes'));
        $job_count = count($jobpost);

        $post_link = get_edit_post_link($post_id);
        $post_link = get_admin_url() . 'edit.php?post_type=resumes&job_id=' . $post_id . '';

        echo $resume = '<a href="' . esc_url($post_link) . '">' . sprintf(__("Ver solicitudes%s", 'custom-post-type-ui'), '(' . $job_count . ')') . '</a>';
    }
}
add_action('manage_jobs_posts_custom_column', 'ajp_view_application_column_value', 10, 2);


/**
 * Add "Nombre del solicitante" custom column Resumes Posts.
 */
function ajp_view_applicants_name_column($columns)
{
    $column = array_merge(
        $columns,
        array(
            'applicants_name' => esc_html__('Nombre del solicitante', 'custom-post-type-ui'),
        )
    );

    return $column;
}
add_filter('manage_resumes_posts_columns', 'ajp_view_applicants_name_column');


/**
 * Add value to "Nombre del solicitante" Column
 */
function ajp_view_applicants_name_column_value($column, $post_id)
{
    if ('applicants_name' == $column) {
        echo '<strong>' . get_post_meta($post_id, 'fullname', true) . '</strong>';
    }
}
add_action('manage_resumes_posts_custom_column', 'ajp_view_applicants_name_column_value', 10, 2);


/**
 * Add application listing filter to admin 
 */
function ajp_add_jobapplication_filter()
{
    $type = 'post';
    if (isset($_GET['post_type'])) {
        $type = sanitize_text_field($_GET['post_type']);
    }

    if ('resumes' == $type) {
        $jobs = array();
        $jobposts = get_posts(
            array(
                'posts_per_page' => -1,
                'post_type' => 'jobs'
            )
        );

        if ($jobposts) :
            foreach ($jobposts as $job) :
                $jobs[$job->ID] = $job->post_title;
            endforeach;
        endif;

        $duplicate_jobs = array_unique(array_diff_assoc($jobs, array_unique($jobs)));

        if (is_array($duplicate_jobs)) :
            foreach ($jobs as $id => $job_title) :
                if (in_array($job_title, $duplicate_jobs)) :
                    $_jobs[$id] = $job_title . '-' . $id;
                else :
                    $_jobs[$id] = $job_title;
                endif;
            endforeach;
        endif;

        $selected_job = isset($_GET['job_id']) ? sanitize_text_field($_GET['job_id']) : '';

        if (!empty($_jobs)) {
?>
            <select name="job_id">
                <option value="0"><?php _e('Todas las vacantes', 'custom-post-type-ui'); ?></option>
                <?php
                foreach ($_jobs as $key => $value) {
                    printf(
                        '<option value="%s"%s>%s</option>',
                        esc_attr($key),
                        $key == $selected_job ? ' selected="selected"' : '',
                        esc_attr($value)
                    );
                }
                ?>
            </select>
        <?php
        }
    }
}
add_action('restrict_manage_posts', 'ajp_add_jobapplication_filter', 10, 1);


/**
 * Add job experience filter to admin 
 */
function ajp_add_jobexperience_filter()
{
    $type = 'post';
    if (isset($_GET['post_type'])) {
        $type = sanitize_text_field($_GET['post_type']);
    }

    if ('resumes' == $type) {

        $selected_experience = isset($_GET['years_experience']) ? sanitize_text_field($_GET['years_experience']) : '';
        $years_experience = array("1", "2", "3", "4", "5", "+5", "+10");

        if (!empty($years_experience)) {
        ?>
            <select name="years_experience">
                <option value="0"><?php _e('Todos los años de experiencia', 'custom-post-type-ui'); ?></option>
                <?php
                foreach ($years_experience as $years) {
                    printf(
                        '<option value="%s"%s>%s</option>',
                        esc_attr($years),
                        $years === $selected_experience ? ' selected="selected"' : '',
                        esc_attr($years)
                    );
                }
                ?>
            </select>
        <?php
        }
    }
}
add_action('restrict_manage_posts', 'ajp_add_jobexperience_filter', 10, 1);


/**
 * Add job experience filter to admin 
 */
function ajp_add_leveleducation_filter()
{
    $type = 'post';
    if (isset($_GET['post_type'])) {
        $type = sanitize_text_field($_GET['post_type']);
    }

    if ('resumes' == $type) {

        $selected_level = isset($_GET['level_education']) ? sanitize_text_field($_GET['level_education']) : '';
        $level_education = array("Primaria", "Bachillerato", "Técnico", "Universitario", "Especialización", "Maestría", "Doctorado");

        if (!empty($level_education)) {
        ?>
            <select name="level_education">
                <option value="0"><?php _e('Todos los niveles de educación', 'custom-post-type-ui'); ?></option>
                <?php
                foreach ($level_education as $level) {
                    printf(
                        '<option value="%s"%s>%s</option>',
                        esc_attr($level),
                        $level == $selected_level ? ' selected="selected"' : '',
                        esc_attr($level)
                    );
                }
                ?>
            </select>
        <?php
        }
    }
}
add_action('restrict_manage_posts', 'ajp_add_leveleducation_filter', 10, 1);


/**
 * Update query for getting all aplications against a filter.
 */
function ajp_get_applications_filter($query)
{
    if (is_admin() && (isset($query->query['post_type']) && 'resumes' == $query->query['post_type'])) {

        if (!empty($_GET['job_id'])) {
            $qv = &$query->query_vars;
            $qv['post_parent'] = sanitize_text_field($_GET['job_id']);
        }

        if (!empty($_GET['years_experience']) && !empty($_GET['level_education'])) {

            $qv = &$query->query_vars;
            $qv['meta_query'] = array(
                'relation' => 'AND',
                array(
                    'key' => 'experience',
                    'value' => serialize(
                        array(sanitize_text_field($_GET['years_experience']))
                    )
                ),
                array(
                    'key' => 'educationalLevel',
                    'value' => serialize(
                        array(sanitize_text_field($_GET['level_education']))
                    )
                )
            );
        } else if (!empty($_GET['years_experience']) && empty($_GET['level_education'])) {

            $qv = &$query->query_vars;
            $qv['meta_query'] = array(
                array(
                    'key' => 'experience',
                    'value' => serialize(
                        array(sanitize_text_field($_GET['years_experience']))
                    )
                )
            );
        } else if (!empty($_GET['level_education']) && empty($_GET['years_experience'])) {

            $qv = &$query->query_vars;
            $qv['meta_query'] = array(
                array(
                    'key' => 'educationalLevel',
                    'value' => serialize(
                        array(sanitize_text_field($_GET['level_education']))
                    )
                )
            );
        }
    }
}
add_filter('parse_query', 'ajp_get_applications_filter');


/**
 * Create export button
 */
function ajp_admin_post_list_top_export_button($which)
{
    $type = 'post';
    if (isset($_GET['post_type'])) {
        $type = sanitize_text_field($_GET['post_type']);
    }

    if ('resumes' == $type && 'top' === $which) {
        ?>
        <input type="submit" name="export_data" id="export_data" class="button button-primary" value="Exportar" />
    <?php
    }
}
add_action('manage_posts_extra_tablenav', 'ajp_admin_post_list_top_export_button', 20, 1);


/**
 * Funcion para limpiar datos en el excel
 */
function ajp_cleanData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);

    if ($str == 't') $str = 'TRUE';
    if ($str == 'f') $str = 'FALSE';

    if (preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) {
        $str = "'$str";
    }

    if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}


/**
 * Export button action
 */
function ajp_func_export_all_posts()
{
    if (isset($_GET['export_data'])) {
        $arg = array(
            'post_type' => 'resumes',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'fields' => 'ids',
            'post_parent' => !empty($_GET['job_id']) ? $_GET['job_id'] : '',
        );

        if (!empty($_GET['years_experience']) && !empty($_GET['level_education'])) {
            $arg['meta_query'] = array(
                'relation' => 'AND',
                array(
                    'key' => 'experience',
                    'value' => serialize(
                        array(sanitize_text_field($_GET['years_experience']))
                    )
                ),
                array(
                    'key' => 'educationalLevel',
                    'value' => serialize(
                        array(sanitize_text_field($_GET['level_education']))
                    )
                )
            );
        } else if (!empty($_GET['years_experience']) && empty($_GET['level_education'])) {
            $arg['meta_query'] = array(
                array(
                    'key' => 'experience',
                    'value' => serialize(
                        array(sanitize_text_field($_GET['years_experience']))
                    )
                )
            );
        } else if (!empty($_GET['level_education']) && empty($_GET['years_experience'])) {
            $arg['meta_query'] = array(
                array(
                    'key' => 'educationalLevel',
                    'value' => serialize(
                        array(sanitize_text_field($_GET['level_education']))
                    )
                )
            );
        }

        global $post;
        $arr_post = get_posts($arg);

        if ($arr_post) {
            $filename = "aplicaciones_" . date('Ymd') . ".xls";

            header("Content-Description: File Transfer");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=\"$filename\"");
            header('Pragma: no-cache');
            header('Expires: 0');

            $fields = array(
                'ID',
                'Nombre',
                'Vacante aplicada'
            );

            $excelData = implode("\t", array_values($fields)) . "\n";

            foreach ($arr_post as $post) {
                $values = array(
                    'ID' => get_the_id(),
                    'Nombre' => get_post_meta($post, 'fullname', true),
                    'Vacante aplicada' => get_the_title()
                );

                array_walk($values, __NAMESPACE__ . '\ajp_cleanData');
                $excelData .= implode("\t", array_values($values)) . "\n";
            }

            echo $excelData;
            exit();
        } else {
            echo '<div class="notice notice-warning is-dismissible"> 
                    <p>No existen registros para exportar.</p>
                 </div>';
        }
    }
}
add_action('init', 'ajp_func_export_all_posts');


/**
 * Save form data to 'Hojas de Vida'
 */
function ajp_action_wpcf7_before_send_mail($contact_form, $abort, $submission)
{
    $form_title = $contact_form->title();

    if ($form_title === "Formulario de solicitudes") {

        $posted_data = $submission->get_posted_data();
        $attachments = $submission->uploaded_files();
        $parent_id = filter_input(INPUT_POST, '_wpcf7_container_post');

        $my_query = array(
            'post_type'    => 'resumes',
            'post_parent'  => intval($parent_id),
            'post_title'   => wp_strip_all_tags(get_the_title($parent_id)),
            'post_content' => '',
            'post_status'  => 'publish'
        );

        $data = wp_insert_post($my_query);

        foreach ($posted_data as $key => $value) {
            update_post_meta($data, $key, $value);
        }

        if (!empty($attachments)) {
            $upload_dir = wp_upload_dir();
            $custom_dir = $upload_dir['basedir'] . '/aplicaciones';
            $custom_url = $upload_dir['baseurl'] . '/aplicaciones';
            // add a sub directory of the submission post id
            $custom_dir .= '/' . $data;

            mkdir($custom_dir, 0755, true);

            foreach ($attachments as $file_path) {
                if (!empty($file_path)) {
                    if (is_array($file_path)) {
                        $file_path = current($file_path);
                    }

                    $file_name = basename($file_path);
                    $file_url = $custom_url . '/' . $data . '/' . $file_name;

                    copy($file_path, $custom_dir . '/' . $file_name);

                    update_post_meta($data, 'image-name', $file_name);
                    update_post_meta($data, 'image-url', $file_url);
                }
            }
        }
    }
};
add_action('wpcf7_before_send_mail', 'ajp_action_wpcf7_before_send_mail', 10, 3);


/**
 * Create Detail Page for show Applicants data
 */
function ajp_jobpost_applicants_detail_page_content()
{
    global $post;

    if (!empty($post) and 'resumes' === $post->post_type) :

        $data_form = get_post_meta($post->ID);

        // Experiencia laboral
        $WE_data = array();

        $companyNameWE = array_values(
            array_filter($data_form, function ($key) {
                return str_starts_with($key, 'companyNameWE');
            }, ARRAY_FILTER_USE_KEY)
        );

        $positionWE = array_values(
            array_filter($data_form, function ($key) {
                return str_starts_with($key, 'positionWE');
            }, ARRAY_FILTER_USE_KEY)
        );

        $responsabilitiesWE = array_values(
            array_filter($data_form, function ($key) {
                return str_starts_with($key, 'responsabilitiesWE');
            }, ARRAY_FILTER_USE_KEY)
        );

        $entryDateWE = array_values(
            array_filter($data_form, function ($key) {
                return str_starts_with($key, 'entryDateWE');
            }, ARRAY_FILTER_USE_KEY)
        );

        $retirementDateWE = array_values(
            array_filter($data_form, function ($key) {
                return str_starts_with($key, 'retirementDateWE');
            }, ARRAY_FILTER_USE_KEY)
        );

        foreach ($companyNameWE as $key => $nameWE) {
            $WE_data[$key]['companyNameWE'] = implode(', ', (array) $nameWE);
        }
        foreach ($positionWE as $key => $posWE) {
            $WE_data[$key]['positionWE'] = implode(', ', (array) $posWE);
        }
        foreach ($responsabilitiesWE as $key => $responsabilityWE) {
            $WE_data[$key]['responsabilitiesWE'] = implode(', ', (array) $responsabilityWE);
        }
        foreach ($entryDateWE as $key => $eDateWE) {
            $WE_data[$key]['entryDateWE'] = implode(', ', (array) $eDateWE);
        }
        foreach ($retirementDateWE as $key => $rDateWE) {
            $WE_data[$key]['retirementDateWE'] = implode(', ', (array) $rDateWE);
        }
        // Fin experiencia laboral


        // Experiencia específica
        $SE_data = array();

        $companyNameSE = array_values(
            array_filter($data_form, function ($key) {
                return str_starts_with($key, 'companyNameSE');
            }, ARRAY_FILTER_USE_KEY)
        );

        $positionSE = array_values(
            array_filter($data_form, function ($key) {
                return str_starts_with($key, 'positionSE');
            }, ARRAY_FILTER_USE_KEY)
        );

        $responsabilitiesSE = array_values(
            array_filter($data_form, function ($key) {
                return str_starts_with($key, 'responsabilitiesSE');
            }, ARRAY_FILTER_USE_KEY)
        );

        $entryDateSE = array_values(
            array_filter($data_form, function ($key) {
                return str_starts_with($key, 'entryDateSE');
            }, ARRAY_FILTER_USE_KEY)
        );

        $retirementDateSE = array_values(
            array_filter($data_form, function ($key) {
                return str_starts_with($key, 'retirementDateSE');
            }, ARRAY_FILTER_USE_KEY)
        );

        foreach ($companyNameSE as $key => $nameSE) {
            $SE_data[$key]['companyNameSE'] = implode(', ', (array) $nameSE);
        }
        foreach ($positionSE as $key => $posSE) {
            $SE_data[$key]['positionSE'] = implode(', ', (array) $posSE);
        }
        foreach ($responsabilitiesSE as $key => $responsabilitySE) {
            $SE_data[$key]['responsabilitiesSE'] = implode(', ', (array) $responsabilitySE);
        }
        foreach ($entryDateSE as $key => $eDateSE) {
            $SE_data[$key]['entryDateSE'] = implode(', ', (array) $eDateSE);
        }
        foreach ($retirementDateSE as $key => $rDateSE) {
            $SE_data[$key]['retirementDateSE'] = implode(', ', (array) $rDateSE);
        }
        // Fin experiencia específica


        // Formación complementaria
        $CT_data = array();

        $trainingType = array_values(
            array_filter($data_form, function ($key) {
                return str_starts_with($key, 'trainingType');
            }, ARRAY_FILTER_USE_KEY)
        );

        $programName = array_values(
            array_filter($data_form, function ($key) {
                return str_starts_with($key, 'programName');
            }, ARRAY_FILTER_USE_KEY)
        );

        $institutionCT = array_values(
            array_filter($data_form, function ($key) {
                return str_starts_with($key, 'institutionCT');
            }, ARRAY_FILTER_USE_KEY)
        );

        $certificationDate = array_values(
            array_filter($data_form, function ($key) {
                return str_starts_with($key, 'certificationDate');
            }, ARRAY_FILTER_USE_KEY)
        );

        foreach ($trainingType as $key => $type) {
            $CT_data[$key]['trainingType'] = implode(', ', (array) $type);
        }
        foreach ($programName as $key => $program) {
            $CT_data[$key]['programName'] = implode(', ', (array) $program);
        }
        foreach ($institutionCT as $key => $institution) {
            $CT_data[$key]['institutionCT'] = implode(', ', (array) $institution);
        }
        foreach ($certificationDate as $key => $date) {
            $CT_data[$key]['certificationDate'] = implode(', ', (array) $date);
        }
        // Fin formación complementaria


        // Herramientas ofimáticas
        $tools_data = array();

        $tools = array_values(
            array_filter($data_form, function ($key) {
                return str_starts_with($key, 'tool');
            }, ARRAY_FILTER_USE_KEY)
        );

        $levels = array_values(
            array_filter($data_form, function ($key) {
                return str_starts_with($key, 'level');
            }, ARRAY_FILTER_USE_KEY)
        );

        foreach ($tools as $key => $tool) {
            $tools_data[$key]['tool'] = implode(', ', (array) $tool);
        }
        foreach ($levels as $key => $level) {
            $tools_data[$key]['level'] = implode(', ', (array) $level);
        }
        // Fin herramientas ofimáticas
    ?>
        <div class="wrap">
            <h1 class="wp-heading-inline">
                Vacante: <?= the_title(); ?> | Candidato #<?= get_the_ID(); ?>
            </h1>

            <img src="<?= implode(', ', (array) $data_form['image-url']) ?>" style="display: block; float: right; max-width: 200px; max-height: 200px; margin-top: 3rem; margin-bottom: 1rem;">

            <table class="widefat striped">
                <!-- Datos personales -->
                <tr>
                    <th colspan="11">
                        <h1>DATOS PERSONALES</h1>
                    </th>
                </tr>
                <tr>
                    <td>
                        <h4>Nombre completo</h4>
                    </td>
                    <td>
                        <h4>Tipo de documento</h4>
                    </td>
                    <td>
                        <h4>Número de documento</h4>
                    </td>
                    <td>
                        <h4>Fecha de nacimiento</h4>
                    </td>
                    <td>
                        <h4>Correo electrónico</h4>
                    </td>
                    <td>
                        <h4>Teléfono</h4>
                    </td>
                    <td>
                        <h4>Teléfono celular</h4>
                    </td>
                    <td>
                        <h4>Ciudad de residencia</h4>
                    </td>
                    <td>
                        <h4>Dirección</h4>
                    </td>
                    <td>
                        <h4>Aspiración salarial</h4>
                    </td>
                    <td>
                        <h4>¿Algún familiar labora en Arconsa?</h4>
                    </td>
                </tr>
                <tr>
                    <td><?= implode(', ', (array) $data_form['fullname']) ?></td>
                    <td>
                        <?= is_serialized($data_form['documentType'][0]) ?
                            unserialize($data_form['documentType'][0])[0] :
                            implode(', ', (array) $data_form['documentType'])
                        ?>
                    </td>
                    <td><?= implode(', ', (array) $data_form['documentNumber']) ?></td>
                    <td><?= implode(', ', (array) $data_form['birthdate']) ?></td>
                    <td><?= implode(', ', (array) $data_form['email']) ?></td>
                    <td><?= implode(', ', (array) $data_form['phone']) ?></td>
                    <td><?= implode(', ', (array) $data_form['cellphone']) ?></td>
                    <td><?= implode(', ', (array) $data_form['city']) ?></td>
                    <td><?= implode(', ', (array) $data_form['address']) ?></td>
                    <td><?= implode(', ', (array) $data_form['salary']) ?></td>
                    <td><?= implode(', ', (array) $data_form['closeRelative']) ?></td>
                </tr>

                <!-- Perfil laboral -->
                <tr>
                    <th colspan="11">
                        <h1>PERFIL LABORAL</h1>
                    </th>
                </tr>
                <tr>
                    <td>
                        <h4>Años de experiencia</h4>
                    </td>
                    <td colspan="2">
                        <h4>¿Por qué deseas trabajar en Arconsa?</h4>
                    </td>
                    <td colspan="2">
                        <h4>Breve resumen de la hoja de vida</h4>
                    </td>
                    <td>
                        <h4>Nivel educativo</h4>
                    </td>
                    <td>
                        <h4>Título obtenido</h4>
                    </td>
                    <td>
                        <h4>Institución</h4>
                    </td>
                    <td>
                        <h4>Estado Académico</h4>
                    </td>
                    <td>
                        <h4>Año de graduación</h4>
                    </td>
                    <td>
                        <h4>¿Tiene tarjeta profesional o licencia?</h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?= is_serialized($data_form['experience'][0]) ?
                            unserialize($data_form['experience'][0])[0] :
                            implode(', ', (array) $data_form['experience'])
                        ?>
                    </td>
                    <td colspan="2"><?= implode(', ', (array) $data_form['whyWantToWork']) ?></td>
                    <td colspan="2"><?= implode(', ', (array) $data_form['summary']) ?></td>
                    <td>
                        <?= is_serialized($data_form['educationalLevel'][0]) ?
                            unserialize($data_form['educationalLevel'][0])[0] :
                            implode(', ', (array) $data_form['educationalLevel'])
                        ?>
                    </td>
                    <td><?= implode(', ', (array) $data_form['degreeObtained']) ?></td>
                    <td><?= implode(', ', (array) $data_form['institution']) ?></td>
                    <td>
                        <?= is_serialized($data_form['academicStatus'][0]) ?
                            unserialize($data_form['academicStatus'][0])[0] :
                            implode(', ', (array) $data_form['academicStatus'])
                        ?>
                    </td>
                    <td><?= implode(', ', (array) $data_form['graduationYear']) ?></td>
                    <td>
                        <?= is_serialized($data_form['professionalLicence'][0]) ?
                            unserialize($data_form['professionalLicence'][0])[0] :
                            implode(', ', (array) $data_form['professionalLicence'])
                        ?>
                    </td>
                </tr>

                <!-- Experiencia laboral -->
                <tr>
                    <th colspan="11">
                        <h1>EXPERIENCIA LABORAL</h1>
                    </th>
                </tr>
                <tr>
                    <td colspan="3">
                        <h4>Nombre de la empresa</h4>
                    </td>
                    <td colspan="2">
                        <h4>Cargo</h4>
                    </td>
                    <td colspan="4">
                        <h4>Funciones</h4>
                    </td>
                    <td>
                        <h4>Fecha de ingreso</h4>
                    </td>
                    <td>
                        <h4>Fecha de retiro</h4>
                    </td>
                </tr>
                <?php foreach ($WE_data as $value) : ?>
                    <tr>
                        <td colspan="3"><?= $value['companyNameWE'] ?></td>
                        <td colspan="2"><?= $value['positionWE'] ?></td>
                        <td colspan="4"><?= $value['responsabilitiesWE'] ?></td>
                        <td><?= $value['entryDateWE'] ?></td>
                        <td><?= $value['retirementDateWE'] ?></td>
                    </tr>
                <?php endforeach; ?>

                <!-- Experiencia específica -->
                <tr>
                    <th colspan="11">
                        <h1>EXPERIENCIA ESPECÍFICA</h1>
                    </th>
                </tr>
                <tr>
                    <td colspan="3">
                        <h4>Nombre de la empresa</h4>
                    </td>
                    <td colspan="2">
                        <h4>Cargo</h4>
                    </td>
                    <td colspan="4">
                        <h4>Funciones</h4>
                    </td>
                    <td>
                        <h4>Fecha de ingreso</h4>
                    </td>
                    <td>
                        <h4>Fecha de retiro</h4>
                    </td>
                </tr>
                <?php foreach ($SE_data as $value) : ?>
                    <tr>
                        <td colspan="3"><?= $value['companyNameSE'] ?></td>
                        <td colspan="2"><?= $value['positionSE'] ?></td>
                        <td colspan="4"><?= $value['responsabilitiesSE'] ?></td>
                        <td><?= $value['entryDateSE'] ?></td>
                        <td><?= $value['retirementDateSE'] ?></td>
                    </tr>
                <?php endforeach; ?>

                <!-- Formación complementaria -->
                <tr>
                    <th colspan="11">
                        <h1>FORMACIÓN COMPLEMENTARIA</h1>
                    </th>
                </tr>
                <tr>
                    <td colspan="3">
                        <h4>Tipo de capacitación o certificación</h4>
                    </td>
                    <td colspan="3">
                        <h4>Nombre del programa</h4>
                    </td>
                    <td colspan="3">
                        <h4>Institución</h4>
                    </td>
                    <td colspan="2">
                        <h4>Fecha de certificación</h4>
                    </td>
                </tr>
                <?php foreach ($CT_data as $value) : ?>
                    <tr>
                        <td colspan="3"><?= $value['trainingType'] ?></td>
                        <td colspan="3"><?= $value['programName'] ?></td>
                        <td colspan="3"><?= $value['institutionCT'] ?></td>
                        <td colspan="2"><?= $value['certificationDate'] ?></td>
                    </tr>
                <?php endforeach; ?>

                <!-- Herramientas ofimáticas, licencias o idiomas -->
                <tr>
                    <th colspan="11">
                        <h1>HERRAMIENTAS OFIMÁTICAS, LÍCENCIAS O IDIOMAS</h1>
                    </th>
                </tr>
                <tr>
                    <td colspan="5">
                        <h4>Herramienta</h4>
                    </td>
                    <td colspan="6">
                        <h4>Nivel</h4>
                    </td>
                </tr>
                <?php foreach ($tools_data as $value) : ?>
                    <tr>
                        <td colspan="5"><?= $value['tool'] ?></td>
                        <td colspan="6">
                            <?= is_serialized($value['level']) ?
                                unserialize($value['level'])[0] :
                                $value['level']
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
<?php endif;
}
add_action('edit_form_after_title', 'ajp_jobpost_applicants_detail_page_content');
