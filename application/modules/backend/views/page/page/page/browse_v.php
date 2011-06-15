<div class="clear"></div>
<div class="list_page">
	<div class="table-Ui">
		<table>
			<thead>
				<tr>
					<td>Title</td>
					<td>Category</td>
					<td>Action</td>
				</tr>
			</thead>
			<?foreach($pages->result() as $page):?>
				<tr>
					<td><?=$page->title?></td>
					<td><?=$page->name?></td>
					<td class="action">
							<a href="<?=site_url('page/view/'.$page->page_id);?>"><span class="act view"></span></a>
							<a href="<?=site_url('backend/page/b_page/update/'.$page->page_id);?>"><span class="act edit"></span></a>
							<a href="<?=site_url('backend/page/b_page/delete/'.$page->page_id);?>"><span class="act del"></span></a>
					</td>
				</tr>
			<?endforeach;?>
		</table>
	</div>
</div>