Dear <?=$person->first_name.' '.$person->last_name?><br/>
<br/>
<p>Your Order with No. <?=$data->id;?>, which Create <?=$this->dodol->custom_time($data->c_date)?> (<?=$data->c_date?>) <br/>
have a new Status, 
</p>
<div class="horline"></div>
<div class="grid_300 ctr mt10 mb10">
<h1 align="center"><?=$data->status?></h1>
</div>
<div class="horline"></div>
<br>
<br>
<p>Regards</p>
<?=$this->config->item('site_name')?>