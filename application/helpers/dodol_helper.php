<?



if ( ! function_exists('ddl_post_filter'))
	{
		function ddl_post_filter($suffix){
			$new_post = array();
			foreach($_POST as $post => $value){
				if(strpos($post, $suffix) !== false):
				$new_index = str_replace($suffix, '', $post);
				$new_post[$new_index] = $value;
				endif;
			}
			if(count($new_post)>0){
				return $new_post;
			}else{
				return false;
			}
		}
	}
if ( ! function_exists('html_word_limiter'))
		{
			function html_word_limiter($string, $limiter = false){
				$output = strip_tags($string);
				if($limiter != false){
					$output = word_limiter($output, $limiter);
				}
				return $output;
			}
		}
	