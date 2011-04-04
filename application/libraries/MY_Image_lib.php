<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Image_lib extends CI_Image_lib {

    var    $background    = array();
    
    function image_process_gd($action = 'resize')
    {    
        $v2_override = FALSE;
            
        if ($action == 'crop')
        {
            // If the target width/height match the source then it's pointless to crop, right?
            // EDITED, fixed crop "short-circuit" bug
            if ($this->width >= $this->orig_width AND $this->height >= $this->orig_height)
            // /EDITED
            {
                // We'll return true so the user thinks the process succeeded.
                // It'll be our little secret...
    
                return TRUE;
            }
            
            //  Reassign the source width/height if cropping
            $this->orig_width  = $this->width;
            $this->orig_height = $this->height;    
                
            // GD 2.0 has a cropping bug so we'll test for it
            if ($this->gd_version() !== FALSE)
            {
                $gd_version = str_replace('0', '', $this->gd_version());            
                $v2_override = ($gd_version == 2) ? TRUE : FALSE;
            }
        }
        else
        {
            // If the target width/height match the source, AND if
            // the new file name is not equal to the old file name
            // we'll simply make a copy of the original with the new name        
            if (($this->orig_width == $this->width AND $this->orig_height == $this->height) AND ($this->source_image != $this->dest_image))
            {
                if ( ! @copy($this->full_src_path, $this->full_dst_path))
                {
                    $this->set_error('imglib_copy_failed');
                    return FALSE;
                }
            
                @chmod($this->full_dst_path, 0777);
                return TRUE;
            }
            
            // If resizing the x/y axis must be zero
            $this->x_axis = 0;
            $this->y_axis = 0;
        }
        
        //  Create the image handle
        if ( ! ($src_img = $this->image_create_gd()))
        {        
            return FALSE;
        }

        //  Create The Image
        if ($this->image_library == 'gd2' AND function_exists('imagecreatetruecolor') AND $v2_override == FALSE)
        {
            $create    = 'imagecreatetruecolor';
            $copy    = 'imagecopyresampled';
        }
        else
        {
            $create    = 'imagecreate';    
            $copy    = 'imagecopyresized';
        }
            
        $dst_img = $create($this->width, $this->height);
        // EDITED, added support for background color
        if (!empty($this->background)) {
            list($r,$g,$b) = $this->background;
            $fill = imagecolorallocate($dst_img, $r, $g, $b);
            imagefill($dst_img, 0, 0, $fill);
        }
        // /EDITED
        $copy($dst_img, $src_img, 0, 0, $this->x_axis, $this->y_axis, $this->width, $this->height, $this->orig_width, $this->orig_height);

        //  Show the image    
        if ($this->dynamic_output == TRUE)
        {
            $this->image_display_gd($dst_img);
        }
        else
        {
            // Or save it
            if ( ! $this->image_save_gd($dst_img))
            {
                return FALSE;
            }
        }

        //  Kill the file handles
        imagedestroy($dst_img);
        imagedestroy($src_img);
        
        // Set the file to 777
        @chmod($this->full_dst_path, 0777);
        
        return TRUE;
    }
    
}