<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Images extends MX_Controller {

    function Images() {
        parent::__construct();

        // directory where source images are stored
        $this->img_dir = './images';

        // directory where cached files will be stored.
        $this->cache_dir = $this->img_dir . '/.cached';

        // image library to use, GD, GD2,
        $this->img_lib = 'GD2';

        // image quality
        $this->quality = 75;

        // bg color if src file has transparent bg, gd defaults to black which is not usually pretty
        $this->background = array(255, 255, 255);

        // max memory limit, used when resizing/cropping to handle large files
        $this->memory_limit = '64M';

        // END OF CONFIGURATION  --------------------------------------- //
    }

    function size() {
    // only function callable externally

        // offset used determining image. not hard coded because ci could be in a sub dir
        $this->offset = array_search(__FUNCTION__, $this->uri->segment_array())+1;

        $file = $this->_get_file_from_uri();
        $src_file = $this->img_dir . $file;
        $dst_size = $this->uri->segment($this->offset);
        $dst_file = $this->cache_dir . '/' . $dst_size . $file;

        if (!is_file($src_file)) show_404();

        if (is_file($dst_file) && (filemtime($src_file) > filemtime($dst_file))) {
        // if src file is newer than the cache file, delete cache
            unlink($dst_file);
            clearstatcache();
        }

        $config = array(
            'new_image' => $dst_file,
            'quality' => $this->quality,
            'source_image' => $src_file
        );
        if ($this->background != FALSE) $config['background'] = $this->background;

        list($src['width'], $src['height']) = getimagesize($src_file);

        if ($dst_size == 'x') {
        // no size given so 404
            show_404();

        } else if (strpos($dst_size, 'x') !== FALSE) {
        // create cache image to fit $dst_size

            list($dst['width'], $dst['height']) = explode('x', $dst_size);

            if (($dst['width'] == $dst['height']) && !file_exists($dst_file)) {
            // image isn't aready cached, crop the image to square
                $crop = $src;
                $crop['new_image'] = dirname($config['new_image']) . '/_' . basename($config['new_image']);
                if ($src['width'] < $src['height']) {
                    $crop['y_axis'] = round(($src['height'] - $src['width']) / 2);
                    $crop['height'] = $src['width'];
                    // if y_axis > height, this is a really tall image, so the focus is probably toward the top, adjust the y_axis
                    while ($crop['y_axis'] > $crop['height']) $crop['y_axis'] /= 2;
                    $crop['library_path'] = '/usr/bin/';

                } else {
                    $crop['x_axis'] = round(($src['width'] - $src['height']) / 2);
                    $crop['width'] = $src['height'];
                }
                $crop  = array_merge($config, $crop);
                $this->_crop_img($crop);
                $dst = array('source_image'=>$crop['new_image'], 'width'=>$dst_size, 'height'=>$dst_size);

            } else {
                // calculate width, height
                if (empty($dst['height'])) $dst['height'] = floor($src['height']*($dst['width']/$src['width']));
                if (empty($dst['width'])) $dst['width'] = floor($src['width']*($dst['height']/$src['height']));
            }

        } else $dst = array('width'=>$dst_size, 'height'=>$dst_size);

        // check that the resized image won't be larger than the original
        if (($src['width'] < $dst['width']) && ($src['height'] < $dst['height'])) $dst = $src;
        $config = array_merge($config, $dst);

        $this->_serve_cached_img($config);
    }

    function _crop_img($config=array()) {
    // perform the resize as specified in config
        // increase memory limit to handle large files
        ini_set('memory_limit', $this->memory_limit);
        $this->load->library('image_lib');

        $default = array(
            'image_library' => $this->img_lib,
            'maintain_ratio' => FALSE
        );
        $config = array_merge($default, $config);
        $this->image_lib->initialize($config);

        $this->_mk_dir(dirname($config['new_image']));
        $result = $this->image_lib->crop();

        if (!$result || !file_exists($config['new_image'])) echo 'Crop: '.$this->image_lib->display_errors();
    }

    function _get_ext($file) {
    // returns file's extension

        return substr($file, strrpos($file, '.')+1);
    }

    function _get_file_from_uri() {
    // returns the requested image from the uri
        $seg_array = $this->uri->segment_array();

        return '/' . implode('/', array_slice($seg_array, $this->offset));
    }

    function _get_mime($file) {
    // returns mime-type based on file extension, hard-coded for now
        $mimes = array('bmp'=>'image/bmp', 'gif'=>'image/gif', 'jpg'=>'image/jpeg', 'png'=>'image/png');

        return $mimes[$this->_get_ext($file)];
    }

    function _mk_dir($path) {
    // recursively  creates directories in path if they don't exist
        if (is_dir($path)) return TRUE;
        if (!$this->_mk_dir(dirname($path), 0777)) return FALSE;
        $old_umask = umask(0);
        $result = mkdir($path, 0777);
        umask($old_umask);

        return $result;
    }

    function _resize_img($config=array()) {
    // perform the resize as specified in config
        // increase memory limit to handle large files
        ini_set('memory_limit', $this->memory_limit);
        $this->load->library('image_lib');
        $default = array(
            'background' => array(255, 255, 255),
            'image_library' => $this->img_lib,
            'maintain_ratio' => TRUE
        );
        $config = array_merge($default, $config);
        $this->image_lib->initialize($config);

        $this->_mk_dir(dirname($config['new_image']));
        $result = $this->image_lib->resize();

        if (!$result) echo $this->image_lib->display_errors();
    }

    function _serve_cached_img($config) {
    // creates and serves cached images
        $src_file = $config['source_image'];
        $cache_file = $config['new_image'];

        if (!file_exists($cache_file)) {
        // cache file doesn't exist, create it
            $this->_resize_img($config);

            // if temp crop file, delete
            if ($src_file == dirname($cache_file).'/_'.basename($cache_file)){ unlink($src_file);}

        } else {
        // else check modified date
            $request = apache_request_headers();
            if (isset($request['If-Modified-Since'])) {
                $modified_since = explode(';', $request['If-Modified-Since']);
                $modified_since = strtotime($modified_since[0]);

            } else $modified_since = 0;

            if (filemtime($cache_file) <= $modified_since) {
            // if not modified, save some cpu and bandwidth
                header('HTTP/1.1 304 Not Modified');
                header('Etag: '.md5($cache_file));
                die;
            }
        }

        // serve cache file
        $mime = $this->_get_mime($cache_file);
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s T', filemtime($cache_file)));
        header('Content-Type: '.$mime);
        header('Content-Length: '.filesize($cache_file)."\n\n");
        header('Etag: '.md5($cache_file));

        readfile($cache_file);
        die;
    }

}