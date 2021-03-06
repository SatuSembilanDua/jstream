<style>
	.mindesc {
	    margin-bottom: 5px;
	    line-height: 21px;
	}
	.alter {
	    display: block;
	    margin-bottom: 5px;
	}
	.spe {
	    margin-bottom: 10px;
	    overflow: hidden;
	    column-count: 2;
	}
	.spe span {
	    margin-bottom: 3px;
	    padding-right: 7px;
	    padding-left: 14px;
	    position: relative;
	    line-height: 19px;
	    display: block;
	}
	.spe span.split {
	    overflow: hidden;
	}
	.genxed {
	    overflow: hidden;
	    margin-bottom: 10px;
	}
	.genxed a {
	    display: inline-block;
	    padding: 4px 8px;
	    margin-right: 5px;
	    margin-bottom: 5px;
	    font-size: 13px;
	    color: #0c70de;
	    border: .5px solid #0c70de;
	    border-radius: 3px;
	}

	.releases {
	    position: relative;
	    display: flex;
	    justify-content: space-between;
	    align-items: baseline;
	    padding: 8px 15px;
	    border-bottom: 1px solid #312f40;
	}
	.releases h1, .releases>h2, .releases h3, #sidebar .section h3 {
	    font-size: 1.1em;
	    color: #FFF;
	    line-height: 20px;
	    font-weight: 500;
	    margin: 0;
	    position: relative;
	}
	.synp .entry-content {
	    margin: 15px;
	    line-height: 21px;
	}
</style>
<?php







?>
<h2><?= $hen['title']; ?></h2>
<div class="row hidden-xs">
	<div class="col-xs-2"><img src="<?= $hen['img']; ?>" class="img-responsive"></div>
	<div class="col-xs-10"><?= html_entity_decode($hen['ninfo']); ?><br><br><br></div>
</div>

<?= html_entity_decode($hen['sinop']); ?>
<br><br>
<h2>Episode</h2>
<table class="table table-list myTable">
	<thead>
		<tr>
			<th>No</th>
			<th>Title</th>
			<th>Date</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($hen['eps'] as $key => $v): ?>
		<tr>
			<td><?= $v['no']; ?></td>
			<td><a href="index.php?page=fhen&b=<?= $_GET['b']; ?>&j=<?= e_url($hen['title']); ?>&g=<?= e_url($v['link']); ?>"><?= $v['title']; ?></a></td>
			<td><?= $v['date']; ?></td>
		</tr>
	<?php endforeach;?>
	</tbody>
</table>