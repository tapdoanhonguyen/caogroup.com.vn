<?php

/**
 * @Project TMS Holdings
 * @Author THƯƠNG MẠI SỐ VIỆT NAM (info@thuongmaiso.com.vn)
 * @Copyright (C) 2014 THƯƠNG MẠI SỐ VIỆT NAM. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 07/04/2017
 */

if (! defined('NV_MAINFILE')) {
    die('Stop!!!');
}

if (! nv_function_exists('nv_block_data_config_html')) {
    function nv_block_data_config_html($module, $data_block, $lang_block)
    {
        global $lang_module;

        if (defined('NV_EDITOR')) {
            require NV_ROOTDIR . '/' . NV_EDITORSDIR . '/' . NV_EDITOR . '/nv.php';
        }

        $htmlcontent = htmlspecialchars(nv_editor_br2nl($data_block['htmlcontent']));
        if (defined('NV_EDITOR') and nv_function_exists('nv_aleditor')) {
            $html = nv_aleditor('htmlcontent', '100%', '150px', $htmlcontent);
        } else {
            $html = '<textarea style="width: 100%" name="htmlcontent" id="htmlcontent" cols="20" rows="8">' . $htmlcontent . '</textarea>';
        }

        return '<tr><td colspan="2">' . $lang_block['htmlcontent'] . '<br>' . $html . '</td></tr>';
    }

    function nv_block_data_config_html_submit($module, $lang_block)
    {
        global $nv_Request;

        $htmlcontent = $nv_Request->get_editor('htmlcontent', '', NV_ALLOWED_HTML_TAGS);
        $htmlcontent = strtr($htmlcontent, array( "\r\n" => '', "\r" => '', "\n" => '' ));

        $return = array();
        $return['error'] = array();
        $return['config'] = array();
        $return['config']['htmlcontent'] = $htmlcontent;

        return $return;
    }

    function nv_block_global_html($block_config)
    {
        return $block_config['htmlcontent'];
    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_block_global_html($block_config);
}
