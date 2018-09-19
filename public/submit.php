<?php

namespace PFCM\Frontend;

class Submit
{
    public function __construct()
    {

    }

    public function save_item($post_id,$post,$update)
    {
        if(isset($_POST['dt'])) :
            parse_str($_POST['dt'], $vars);
            
            if (!empty($vars['pfuploadimagesrc-loc'])) :

                $uploadimages = pfstring2BasicArray($vars['pfuploadimagesrc-loc']);
                $i = 0;
                foreach ($uploadimages as $uploadimage) :
                    delete_post_meta( $uploadimage, 'pointfinder_delete_unused');
                    $postthumbid = get_post_thumbnail_id($post_id);
                    update_post_meta($post_id, 'webbupointfinder_item_images_loc', $uploadimage);
                endforeach;

            endif;
        endif;
    }

    public function display_custom_fields($fields)
    {
        ob_start();

        require PFCM_DIR.'/public/partials/custom-field.php';

        $fields .= ob_get_contents();
        ob_end_clean();

        return $fields;
    }
}
