<div class="coll_list">
<?if($colls):?>
<?foreach($colls as $data):?>
<?
$q= modules::run('store/collection/exe_getById', $data->id);
$items = $q['ref'];
$coll = $q['main'];

?>
<div class="item">
	<a href="<?=site_url('store/collection/detail/'.$coll->id.'/'.$this->theme->nice_strlink($coll->name))?>">
<img src="<?=site_url('thumb/show/730-200-crop/dir/assets/collection_img/'.$coll->img_path);?>" />
</a>
</div>
<?endforeach?>
<?else:?>
There are no collection yet

<?endif?>
</div>