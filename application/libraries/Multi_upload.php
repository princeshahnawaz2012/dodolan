<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
* This library assumes that you have already loaded the default CI Upload Library seperately
* 
* Functions is based upon CI_Upload, Feel free to modify this 
*   library to function as an extension to CI_Upload
* 
* Library modified by: Alvin Mites
* http://www.mitesdesign.com
* 
*/

class Multi_upload  {
	function Multi_upload () {
//		$CI =& get_instance();
	}
	
	/**
	 * Perform multiple file uploads
     * Based upon JQuery Multiple Upload Class
     * see http://www.fyneworks.com/jquery/multiple-file-upload/
	 */	
	function go_upload($field = 'userfile') {
        $CI =& get_instance(); 
		// Is $_FILES[$field] set? If not, no reason to continue.
		if ( ! isset($_FILES[$field]['name'][0]))
		{
			$CI->upload->set_error('upload_no_file_selected');
			return FALSE;
		} else
		{
			$num_files = count($_FILES[$field]['name']) -1;
            $file_list = array();
            $error_hold = array();
            $error_upload = FALSE;
		}
		
        // Is the upload path valid?
        if ( ! $CI->upload->validate_upload_path())
        {
            // errors will already be set by validate_upload_path() so just return FALSE
            return FALSE;
        }
        
        for ($i=0; $i < $num_files; $i++) {
            
//            $fname = $_FILES[$field]['name'][$i];
//            echo "$fname\n\n<br><br>\n\n";

            $error_hold[$i] = FALSE;
                        
            // Was the file able to be uploaded? If not, determine the reason why.
            if ( ! is_uploaded_file($_FILES[$field]['tmp_name'][$i]))
            {
                $error = ( ! isset($_FILES[$field]['error'][$i])) ? 4 : $_FILES[$field]['error'][$i];

                switch($error)
                {
                    case 1:  // UPLOAD_ERR_INI_SIZE
                        $error_hold[$i] = 'upload_file_exceeds_limit';
                        break;
                    case 2: // UPLOAD_ERR_FORM_SIZE
                        $error_hold[$i] = 'upload_file_exceeds_form_limit';
                        break;
                    case 3: // UPLOAD_ERR_PARTIAL
                       $error_hold[$i] = 'upload_file_partial';
                        break;
                    case 4: // UPLOAD_ERR_NO_FILE
                       $error_hold[$i] = 'upload_no_file_selected';
                        break;
                    case 6: // UPLOAD_ERR_NO_TMP_DIR
                        $error_hold[$i] = 'upload_no_temp_directory';
                        break;
                    case 7: // UPLOAD_ERR_CANT_WRITE
                        $error_hold[$i] = 'upload_unable_to_write_file';
                        break;
                    case 8: // UPLOAD_ERR_EXTENSION
                        $error_hold[$i] = 'upload_stopped_by_extension';
                        break;
                    default :
                        $error_hold[$i] = 'upload_no_file_selected';
                        break;
                }

                return FALSE;
            }

            // Set the uploaded data as class variables
            $CI->upload->file_temp = $_FILES[$field]['tmp_name'][$i];        
            $CI->upload->file_name = $CI->upload->_prep_filename($_FILES[$field]['name'][$i]);
            $CI->upload->file_size = $_FILES[$field]['size'][$i];        
            $CI->upload->file_type = preg_replace("/^(.+?);.*$/", "\\1", $_FILES[$field]['type'][$i]);
            $CI->upload->file_type = strtolower($CI->upload->file_type);
            $CI->upload->file_ext  = $CI->upload->get_extension($_FILES[$field]['name'][$i]);
            
            // Convert the file size to kilobytes
            if ($CI->upload->file_size > 0)
            {
                $CI->upload->file_size = round($CI->upload->file_size/1024, 2);
            }

            // Is the file type allowed to be uploaded?
            if ( ! $CI->upload->is_allowed_filetype())
            {
                $error_hold[$i] = 'upload_invalid_filetype';
            }

            // Is the file size within the allowed maximum?
            if ( ! $CI->upload->is_allowed_filesize())
            {
                $error_hold[$i] = 'upload_invalid_filesize';
            }

            // Are the image dimensions within the allowed size?
            // Note: This can fail if the server has an open_basdir restriction.
            if ( ! $CI->upload->is_allowed_dimensions())
            {
                $error_hold[$i] = 'upload_invalid_dimensions';
            }

            // Sanitize the file name for security
            $CI->upload->file_name = $CI->upload->clean_file_name($CI->upload->file_name);

            // Remove white spaces in the name
            if ($CI->upload->remove_spaces == TRUE)
            {
                $CI->upload->file_name = preg_replace("/\s+/", "_", $CI->upload->file_name);
            }

            /*
             * Validate the file name
             * This function appends an number onto the end of
             * the file if one with the same name already exists.
             * If it returns false there was a problem.
             */
            $CI->upload->orig_name = $CI->upload->file_name;

            if ($CI->upload->overwrite == FALSE)
            {
                $CI->upload->file_name = $CI->upload->set_filename($CI->upload->upload_path, $CI->upload->file_name);
                
                if ($CI->upload->file_name === FALSE)
                {
                    $error_hold[$i] = TRUE;
                }
            }

            /*
             * Move the file to the final destination
             * To deal with different server configurations
             * we'll attempt to use copy() first.  If that fails
             * we'll use move_uploaded_file().  One of the two should
             * reliably work in most environments
             */
            if ( ! @copy($CI->upload->file_temp, $CI->upload->upload_path.$CI->upload->file_name))
            {
                if ( ! @move_uploaded_file($CI->upload->file_temp, $CI->upload->upload_path.$CI->upload->file_name))
                {
                     $error_hold[$i] = 'upload_destination_error';
                }
            }
            
            /*
             * Run the file through the XSS hacking filter
             * This helps prevent malicious code from being
             * embedded within a file.  Scripts can easily
             * be disguised as images or other file types.
             */
            if ($CI->upload->xss_clean == TRUE)
            {
                $CI->upload->do_xss_clean();
            }
            
            if ($error_hold[$i]) {
                $error_upload = TRUE;
                
//                echo $error_hold[$i];
            } else {
                if ($imageVar = $this->multiple_image_properties($CI->upload->upload_path.$CI->upload->file_name)) {

                    $file_list[] = array(
                            'name' => $CI->upload->file_name,
                            'file' => $CI->upload->upload_path.$CI->upload->file_name,
                            'size' => $CI->upload->file_size,
                            'ext' => $CI->upload->file_ext,
                            'image_type' => $imageVar->image_type,
                            'height' => $imageVar->height,
                            'width' => $imageVar->width
                            );
                } else {
                    $file_list[] = array(
                            'name' => $CI->upload->file_name,
                            'file' => $CI->upload->upload_path.$CI->upload->file_name,
                            'size' => $CI->upload->file_size,
                            'type' => $CI->upload->file_type,
                            'ext' => $CI->upload->file_ext,
                            );
                }
            }

// For debugging
/*            
            if (strlen($error_hold[$i]) > 1) {
                    print_r($error_hold);
            }
*/            
        } // end for loop

// Add error display for individual files        
        if ($error_upload) {
            $this->set_error($error_hold);
            return FALSE;
        } else {
            return $file_list;
        }    
    }
    
    // --------------------------------------------------------------------

    /**
     * Set Image Properties
     *
     * Uses GD to determine the width/height/type of image
     *
     * @access    public
     * @param    string
     * @return    void
     */    
    function multiple_image_properties($path = '')
    {
        $CI =& get_instance(); 
        if ( ! $CI->upload->is_image())
        {
            return false;
        }

        if (function_exists('getimagesize'))
        {
            if (FALSE !== ($D = @getimagesize($path)))
            {    
                $types = array(1 => 'gif', 2 => 'jpeg', 3 => 'png');

                $image->width       = $D['0'];
                $image->height      = $D['1'];
                $image->image_type        = ( ! isset($types[$D['2']])) ? 'unknown' : $types[$D['2']];
                
                return $image;
            }
        }
    }
    
    // --------------------------------------------------------------------

    /**
     * Set an error message
     *
     * @access    public
     * @param    string
     * @return    void
     */    
    function set_error($msg)
    {
        $CI =& get_instance();    
        $CI->lang->load('upload');
        
        if (is_array($msg))
        {
            foreach ($msg as $val)
            {
                $msg = ($CI->lang->line($val) == FALSE) ? $val : $CI->lang->line($val);                
                $this->error_msg[] = $msg;
                log_message('error', $msg);
            }        
        }
        else
        {
            $msg = ($CI->lang->line($msg) == FALSE) ? $msg : $CI->lang->line($msg);
            $this->error_msg[] = $msg;
            log_message('error', $msg);
        }
    }
    
    // --------------------------------------------------------------------
}
?>
